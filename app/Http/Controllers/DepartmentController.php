<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class DepartmentController extends Controller
{
    public function index()
    {
        return Redirect('Departments');
    }
    public function Departments()
    {
        if (!Auth::check()) {
            Session::flash('status', 'You Must Login First');
            return Redirect('/');
        }
        $departments = DB::table('departments')
            ->select(DB::raw("name,id,active"))
            ->where('active','1')
            ->get()->toArray();
        $inactive_departments = DB::table('departments')
            ->select(DB::raw("name,id,active"))
            ->where('active','0')
            ->get()->toArray();
        return view('Departments.department',compact('departments','inactive_departments'));
    }
    public function createDepartment(Request $request){
        $validator =  [
            'name' => 'required|alpha|unique:departments|max:255',
        ];
        $this->validate($request,$validator);
        $data = $request->all();
        DB::table('departments')->insert(["name"=>$data['name'],"active"=>'1']);
        Session::flash('status', 'Department has been created successfully ');
        return Redirect('Departments');
    }
    public function revert_to_inactive($id){
        DB::table('departments')->where('id', $id)->update(['active'=>'0']);
        Session::flash('status', 'Department has been rendered Inactive ');
        return Redirect('Departments');

    }
    public function revert_to_active($id){
        DB::table('departments')->where('id', $id)->update(['active'=>'1']);
        Session::flash('status', 'Department has been rendered Active ');
        return Redirect('Departments');

    }

    public function updateDepartment(Request $request ,$id){
        $validator =  [
            'name' => 'required|alpha_spaces|max:255',
        ];
        $this->validate($request,$validator);
        $data = $request->all();
        $validation = DB::table('departments')->where('name',$data['name']) ->where('id','<>',$id);
        if($validation->count() > 0 ){
            Session::flash('error', 'Oops! Department already Exists');
            return  Redirect ('edit_department/'.$id);
        }
        else{
            DB::table('departments')->where('id', $id)->update(['name'=>$data['name']]);
            Session::flash('status', 'Department has been updated successfully ');
            return  Redirect('Departments');
        }
    }

}
