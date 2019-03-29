<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'LogsController@index')->name('home');

Route::get('dashboard', [
    'as' => 'dashboard', 'uses' => 'LogsController@dashboard'
]);
Route::post('date_range', [
    'as' => 'date_range', 'uses' => 'LogsController@update_date_range'
]);

Route::get('Departments', [
    'as' => 'Departments', 'uses' => 'DepartmentController@Departments'
]);
Route::get('/new_department', function () {
    if (!Auth::check()) {
        Session::flash('status', 'You Must Login First');
        return Redirect('/');
    }
    return view('Departments.create');
});

Route::post('create_department', [
    'as' => 'create_department', 'uses' => 'DepartmentController@createDepartment'
]);

Route::get('revert_to_inactive/{id}',[
   'as' => 'revert_inactive', 'uses' => 'DepartmentController@revert_to_inactive'
]);

Route::get('revert_to_active/{id}',[
    'as' => 'revert_active', 'uses' => 'DepartmentController@revert_to_active'
]);

Route::get('edit_department/{id}', function ($id) {
    if (!Auth::check()) {
        Session::flash('status', 'You Must Login First');
        return Redirect('/');
    }
    $department = DB::table('departments')->find($id);
    return view('Departments.edit',compact('department'));
});

Route::Put('updateDepartment/{id}',[
    'as'=> 'updateDepartment' ,'uses' => 'DepartmentController@updateDepartment'
]);


Route::get('Computers/{id}', [
    'as' => 'Computers', 'uses' => 'ComputersController@Computers'
]);

Route::get('/newcomputer/{id}', function ($id) {
    if (!Auth::check()) {
        Session::flash('status', 'You Must Login First');
        return Redirect('/');
    }
    $department_name = DB::table('departments')->select('name')->where('id', $id)->first();
    return view('Computers.create',compact('id','department_name'));
});

Route::post('createComputer/{id}', [
    'as' => 'createComputer', 'uses' => 'ComputersController@createComputer'
]);

Route::get('revert_to_inactive_computers/{id}/{department_id}',[
    'as' => 'revert_inactive_computers', 'uses' => 'ComputersController@revert_to_inactive_computers'
]);

Route::get('revert_to_active_computers/{id}/{department_id}',[
    'as' => 'revert_active_computers', 'uses' => 'ComputersController@revert_to_active_computers'
]);
Route::get('/editComputer/{id}/{department_id}', function ($id,$department_id) {
    if (!Auth::check()) {
        Session::flash('status', 'You Must Login First');
        return Redirect('/');
    }
    $department_name = DB::table('departments')->select('name')->where('id', $department_id)->first();
    $computer= DB::table('computers')->find($id);
    return view('Computers.edit',compact('computer','id','department_id','department_name'));
});

Route::Put('updateComputer/{id}/{department_id}',[
    'as'=> 'updateComputer' ,'uses' => 'ComputersController@updateComputer'
]);



Route::get('Mac_addresses/{id}/{computer_id}', [
    'as' => 'Mac_addresses', 'uses' => 'Mac_addressController@Mac_addresses'
]);

Route::get('/new_mac_address/{id}/{computers_id}', function ($id,$computers_id) {
    if (!Auth::check()) {
        Session::flash('status', 'You Must Login First');
        return Redirect('/');
    }
    $computer_name = DB::table('computers')->select('custodian')->where('id',$id)->first();
    return view('Mac_address.create',compact('id','computers_id','computer_name'));
});

Route::post('createMac_address/{id}/{computers_id}', [
    'as' => 'createMac_address', 'uses' => 'Mac_addressController@createMac_address'
]);

Route::get('/editMac_address/{id}/{computer_id}', function ($id,$computers_id) {
    if (!Auth::check()) {
        Session::flash('status', 'You Must Login First');
        return Redirect('/');
    }
    $computer_name = DB::table('computers')->select('custodian')->where('id',$computers_id)->first();
    $mac_address= DB::table('mac_addresses')->find($id);
    $computer_id= DB::table('computers')->find($computers_id);
    return view('Mac_address.edit',compact('mac_address','computer_id','computer_name'));
});

Route::Put('updateMac_address/{id}/{computer_id}/{department_id}',[
    'as'=> 'updateMac_address' ,'uses' => 'Mac_addressController@updateMac_address'
]);


Route::get('Users', [
    'as' => 'Users', 'uses' => 'UserController@Users'
]);

Route::post('user_date_range/{id}', [
    'as' => 'user_date_range', 'uses' => 'UserController@update_date_range'
]);
Route::get('view_user/{id}', [
    'as' => 'view_user', 'uses' => 'UserController@view_user'
]);