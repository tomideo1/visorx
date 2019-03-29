<?php

namespace App\Http\Controllers;
use App\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LogsController extends Controller
{

    public function index()
    {
       return Redirect('dashboard');
    }

    public function dashboard() {
        if (!Auth::check()) {
            Session::flash('status', 'You Must Login First');
            return Redirect('/');
        }

        if (!(Session::has('start_date') && Session::has('end_date'))) {
            Session::put('start_date', date('Y-m-d',strtotime('-3 days')));
            Session::put('end_date', date('Y-m-d'));
        }

        $data_used = DB::table('data_usage')

            ->join('computers', 'data_usage.computer_name', '=', 'computers.computer_name')

            ->where('computers.active', true)

            ->where('date_time_logged', '>=', Session::get('start_date'))

            ->where('data_usage.date_time_logged', '<=', Session::get('end_date').' 23:59:59')
//                ->where(function ($query) {
//
//                    $query->where('processed_logs.source_mac', '=', 'mac_addresses.mac_address')
//
//                        ->orWhere('processed_logs.destination_mac', '=', 'mac_addresses.mac_address');
//
//                })

            ->groupBy('computer_name', 'logged_on_user','computers.custodian','computers.id')

            ->select('data_usage.computer_name', 'data_usage.logged_on_user', 'computers.custodian','computers.id',
                DB::raw('SUM(bytes_sent) + SUM(bytes_received) as used_data'))

            ->orderBy('used_data', 'desc')

            ->get();



        $url_logs = DB::table('processed_logs')->select(DB::raw("processed_logs.url,count(processed_logs.url) as url_count, processed_logs.logged_on_user as user"))

            ->where('processed_logs.date_time_logged', '>=', Session::get('start_date'))

            ->where('processed_logs.date_time_logged', '<=', Session::get('end_date').' 23:59:59')
            ->where(function ($query) {

                $query->where('processed_logs.url', '!=', '')

                    ->orWhere('processed_logs.url',  'IS NOT NULL');

            })

            ->groupBy('url')->groupBy('user')->orderBy('url_count', 'DESC')->get();

        $domain_logs = DB::table('processed_logs')->select(DB::raw("processed_logs.domain_name,count(processed_logs.domain_name) as domain_count"))

            ->where('processed_logs.date_time_logged', '>=', Session::get('start_date'))

            ->where('processed_logs.date_time_logged', '<=', Session::get('end_date').' 23:59:59')
            ->where(function ($query) {

                $query->where('processed_logs.domain_name', '!=', '')

                    ->orWhere('processed_logs.domain_name',  'IS NOT NULL');

            })

            ->groupBy('processed_logs.domain_name' )->orderBy('domain_count', 'DESC')->get();

//        $admin_count = DB::table('users')->select(DB::raw("count(id) as id_count"))
//            ->get();

        $registered_computers = DB::table('computers')
            ->select(DB::raw(" count(id) as computer_count"))
            ->get();

        $active_users = DB::table('data_usage')
            ->join('computers', 'data_usage.computer_name', '=', 'computers.computer_name')

            ->join('mac_addresses', 'computers.id', '=', 'mac_addresses.computer_id')

            ->where('computers.active', true)

            ->where('data_usage.date_time_logged', '>=', Session::get('start_date'))

            ->where('data_usage.date_time_logged', '<=', Session::get('end_date').' 23:59:59')

            ->groupBy('computers.computer_name')

            ->select( DB::raw('computers.computer_name'))

            ->get();
        $total_data = DB::table("data_usage")
            ->join('computers', 'data_usage.computer_name', '=', 'computers.computer_name')

            ->where('computers.active', true)

            ->where('data_usage.date_time_logged', '>=', Session::get('start_date'))

            ->where('data_usage.date_time_logged', '<=', Session::get('end_date').' 23:59:59')

            ->select(DB::raw('SUM(bytes_received)+ SUM(bytes_sent) as total_sum'))

            ->get();
    //    dd($total_data);

        global $computer_count;

        foreach ($registered_computers as $computers){
            $computer_count = $computers->computer_count;
        }

        $active_users_count = sizeof($active_users->toArray());
        $inactive_users = ($computer_count - $active_users_count);


        return view('home', compact('active_users', 'url_logs','domain_logs', 'admin_count',
                                                    'registered_computers','data_used','total_data','inactive_users'));
    }

    public function update_date_range(Request $request) {
        Session::put('start_date', $request->input('start_date'));
        Session::put('end_date', $request->input('end_date'));

        return Redirect::route('dashboard');
    }

}
