@extends('layouts.visorx')
@section('content')
    <h3 class="text-capitalize" style="color:#606688;"> USERS</h3>
    <hr>
    <div class="p-3"></div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-header">List of Users</h4>
                    <div class="card-body">
                        <div class="col-md-12 offset-md-3">
                            <div class="form-group form-inline">
                                <input id="search5" type="text" class="form-control"
                                       placeholder="Search......" style="width: 300px;">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table5">
                                <thead>
                                <tr>
                                    <th>Custodian</th>
                                    <th>Computer Name</th>
                                    <th>Department</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{!! $user->custodian !!}</td>
                                        <td>{!! $user->computer_name !!}</td>
                                        <td>{!! $user->name!!}</td>
                                        <td>
                                            <a href="{!! url('view_user',$user->id) !!}">
                                                <button class="btn btn-primary btn-rounded ">View More</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection