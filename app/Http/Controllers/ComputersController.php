<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class ComputersController extends Controller
{
    public function Computers($id)
    {
        if (!Auth::check()) {
            Session::flash('status', 'You Must Login First');
            return Redirect('/');
        }
        $page_error = DB::table('departments')->find($id);
        if (!$page_error) {
            return abort(404);
        }
        $computers = DB::table('computers')->where('department_id', $id)
            ->where('active', '1')
            ->get();
        $department_name = DB::table('departments')->select('name')->where('id', $id)->first();
        $inactive_computers = DB::table('computers')->where('department_id', $id)
            ->where('active', '0')
            ->get();
        return view('Computers.computers', compact('computers', 'id', 'inactive_computers', 'department_name'));
    }

    public function createComputer(Request $request, $id)
    {
        $validator = [
            'computer_name' => 'required|regex:/^[A-Za-z0-9. -]+$/|unique:computers|max:255',
            'custodian' => 'required|alpha_spaces|unique:computers|max:255',
        ];
        $this->validate($request, $validator);
        $data = $request->all();
        DB::table('computers')->insert(["computer_name" => $data['computer_name'],
            "custodian" => $data['custodian'], "active" => '1', "department_id" => $id]);
        Session::flash('status', 'Computer has been created successfully ');
        return Redirect('Computers/' . $id);
    }

    public function revert_to_inactive_computers($id, $department_id)
    {
        DB::table('computers')->where('id', $id)->update(['active' => '0']);
        Session::flash('status', 'Computer has been rendered Inactive ');
        return Redirect('Computers/' . $department_id);

    }

    public function revert_to_active_computers($id, $department_id)
    {
        DB::table('computers')->where('id', $id)->update(['active' => '1']);
        Session::flash('status', 'Computer has been rendered Active ');
        return Redirect('Computers/' . $department_id);

    }

    public function updateComputer(Request $request, $id, $department_id)
    {
            $validator = [
                'computer_name' => 'required|regex:/^[A-Za-z0-9. -]+$/|max:255',
                'custodian' => 'required|alpha_spaces|max:255',
            ];
            $this->validate($request, $validator);
        $data = $request->all();
        $validation_computer_name = DB::table('computers')->where([
                ['computer_name', '=', $data['computer_name']],
                ['id','<>',$id]
            ]);
        $validation_custodian = DB::table('computers')->where([
            ['custodian', '=', $data['custodian']],
            ['id','<>',$id]
        ]);
            if ($validation_computer_name->count() > 0 || $validation_custodian->count()>0) {
                Session::flash('error', 'Oops! Computer Already Exists');
                return  Redirect('editComputer/'.$id.'/'.$department_id);
            } else {
                DB::table('computers')->where('id', $id)->update(['computer_name'=>$data['computer_name'],
                    'custodian'=>$data['custodian']]);
                Session::flash('status', 'Computer  has been updated successfully ');
                return  Redirect('Computers/'.$department_id);
            }
        }
    }
