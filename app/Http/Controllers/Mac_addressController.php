<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Mac_addressController extends Controller
{
    public function Mac_addresses($id,$computers_id){

        if (!Auth::check()) {
            Session::flash('status', 'You Must Login First');
            return Redirect('/');
        }
        $mac_addresses = DB::table('mac_addresses')->where('computer_id',$id)
            ->where('active','1')
            ->get()->toArray();
        $computer_name = DB::table('computers')->select('custodian')->where('id',$id)->first();
        return view('Mac_address.mac_address',compact('mac_addresses','id','inactive_mac_addresses','computer_name','computers_id'));
    }

    public function createMac_address(Request $request,$id,$computers_id){
        $validator =  [
            'mac_address' => 'required|mac_address|unique:mac_addresses',
            'channel' => 'required|numeric',
        ];
        $this->validate($request,$validator);
        $data = $request->all();
        $mac_count = DB::table('mac_addresses')->select(DB::raw('count(mac_address) as count'))->where('computer_id','=',$id)->get()->toArray();
        foreach ($mac_count as $count) {
            if ($count->count == 2) {
                Session::flash('error', 'Oops!  User Already has Two Mac Addresses');
                return Redirect('Mac_addresses/'.$id.'/'.$computers_id);
            }
            DB::table('mac_addresses')->insert(["computer_id"=>$id,
                "mac_address"=>$data['mac_address'],"channel"=>$data['channel'],"active"=>'1']);
            Session::flash('status', 'User Mac Address has been created successfully ');
            dd($id,$computers_id);
            return Redirect('Mac_addresses/'.$id.'/'.$computers_id);
        }
    }


    public function updateMac_address(Request $request ,$id,$computer_id,$department_id){
        $validator =  [
            'mac_address' => 'required|mac_address|',
        ];
        $this->validate($request,$validator);
        $data = $request->all();
        $validation = DB::table('mac_addresses')->where('mac_address',$data['mac_address']) ->where('id','<>',$id);
        if($validation->count() > 0 ){
            Session::flash('error', 'Oops! Mac Address already Exists');
            return  Redirect ('editMac_address/'.$id.'/'.$computer_id);
        }
        else{
            DB::table('mac_addresses')->where('id', $id)->update(['mac_address'=>$data['mac_address']]);
            Session::flash('status', 'Mac Address has been updated successfully ');
            return  Redirect('Mac_addresses/'.$computer_id.'/'.$department_id);
        }
    }
}
