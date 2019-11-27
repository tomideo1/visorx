<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DateTime;
use DatePeriod;
use DateInterval;

class UserController extends Controller
{
   public function Users(){
       if (!Auth::check()) {
           Session::flash('status', 'You Must Login First');
           return Redirect('/');
       }
       $users = DB::table('computers')
           ->join('departments','departments.id','computers.department_id')
           ->where('computers.active','1')
           ->groupBy('computers.computer_name','computers.custodian','computers.id','departments.name')
           ->select(DB::raw('computers.computer_name,computers.custodian,computers.id,departments.name'))
           ->get();
       return view('Users.user',compact('users'));
   }
   public function view_user($id){
       if (!Auth::check()) {
           Session::flash('status', 'You Must Login First');
           return Redirect('/');
       }
       $user_details = DB::table('computers')
           ->where('id',$id)
           ->first();
       $datetime_1 = new DateTime( Session::get('start_date'));
       $datetime_2 = new DateTime(Session::get('end_date').'23:59:59');
       $daterange = new DatePeriod($datetime_1, new DateInterval('P1D'), $datetime_2);
       $date_interval = [];
       foreach($daterange as $date){
         array_push(  $date_interval,$date->format("Y-m-d"));
       }
       $data_interval = [];
       foreach ($date_interval as $date){
           $query_user =  DB::table('data_usage')
               ->where('computer_name',$user_details->computer_name)
               ->where('date_time_logged','like','%'.$date.'%')
               ->select(DB::raw('SUM(bytes_sent) as used_data_sent, SUM(bytes_received) as 
           used_data_received'))
               ->get()->toArray();
           array_push(  $data_interval,$query_user);
       }
       $url_logs = DB::table('processed_logs')->select(DB::raw("processed_logs.url,count(processed_logs.url) as url_count, processed_logs.logged_on_user as user"))

           ->where('processed_logs.date_time_logged', '>=', Session::get('start_date'))

           ->where('processed_logs.date_time_logged', '<=', Session::get('end_date').' 23:59:59')

           ->where('computer_name','=',$user_details->computer_name)

           ->where(function ($query) {

               $query->where('processed_logs.url', '!=', '')

                   ->orWhere('processed_logs.url',  'IS NOT NULL');

           })

           ->groupBy('url')->groupBy('user')->orderBy('url_count', 'DESC')->get();



       $domain_logs = DB::table('processed_logs')->select(DB::raw("processed_logs.domain_name,count(processed_logs.domain_name) as domain_count"))

           ->where('processed_logs.date_time_logged', '>=', Session::get('start_date'))

           ->where('processed_logs.date_time_logged', '<=', Session::get('end_date').' 23:59:59')

           ->where('computer_name','=',$user_details->computer_name)

           ->where(function ($query) {

               $query->where('processed_logs.domain_name', '!=', '')

                   ->orWhere('processed_logs.domain_name',  'IS NOT NULL');

           })

           ->groupBy('processed_logs.domain_name' )->orderBy('domain_count', 'DESC')->get();

       return view('Users.dashboard',compact('id','user_details','date_interval','data_interval','url_logs','domain_logs'));
   }

    public function update_date_range(Request $request,$id) {
        Session::put('start_date', $request->input('start_date'));
        Session::put('end_date', $request->input('end_date'));

        return Redirect::route('view_user',$id);
    }
}
