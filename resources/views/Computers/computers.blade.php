@extends('layouts.visorx')
@section('content')
    @if (Session::has('status'))
        <div class="col-md-12 alert  alert-success" role="alert">
            {{ Session::get('status') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="col-md-12 alert  alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="col-md-12 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-12 container-fluid">
        <h4 class="card-subtitle" style="color: #3B426C;">{!! $department_name->name  !!}&nbsp;&nbsp;Computers</h4>
        <hr>
        <a href="{!! url('newcomputer',$id) !!}"><button class="btn btn-primary btn-rounded"><i class="fa
        fa-plus">&nbsp;</i>New Computer</button></a>
        <a href="{{route('Departments')}}" ><button class="btn btn-primary btn-rounded"><i class="fa
        fa-arrow-circle-left"></i>&nbsp;&nbsp;
               Back to  Departments</button></a>
        <div class="row">
            <div class="col-md-12" id="accordion">
                <div class="card mt-3">
                    <h6 class="card-header" id="headingOne">Active
                        <span class="fa fa-caret-down float-lg-right"  data-toggle="collapse" data-target="#collapseOne"
                              aria-expanded="false" aria-controls="collapseOne" id="active">
                        </span>
                    </h6>
                    <div class="card-body collapse show"  id="collapseOne" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        <div class="col-md-12 offset-md-3">
                            <div class="form-group form-inline">
                                <input id="search4" type="text" class="form-control"
                                       placeholder="Search......" style="width: 300px;">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table4">
                                <thead>
                                <tr>
                                    <th>Custodian</th>
                                    <th>Computer Name</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($computers as $computer)
                                    <tr>
                                        <td >{!! $computer->custodian !!}</td>
                                        <td>{!! $computer->computer_name !!}
                                        </td>
                                        <td>
                                            <a href="{!!  url('Mac_addresses/'.$computer->id,$computer->department_id)
                                            !!}">
                                                <button class="btn btn-primary ml-5">Mac Address</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{!! url('editComputer/'.$computer->id,$computer->department_id)
                                            !!}">
                                                <i class="fa fa-edit ml-5 text-primary"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{!! url('revert_to_inactive_computers/'.$computer->id,
                                            $computer->department_id)
                                             !!}"
                                               onclick="return isConfirm()">
                                                <i class="fa fa-trash ml-5
                                       text-danger" data-toggle="tooltip" data-placement="top" title="Set Inactive">
                                                </i>
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
            <div class="col-md-12" >
                <div class="card mt-3" id="headingTwo">
                    <h6 class="card-header">InActive
                        <span class="fa fa-caret-down float-lg-right" data-toggle="collapse" data-target="#collapseTwo"
                              aria-expanded="true" aria-controls="collapseTwo" id="inactive">

                        </span>
                    </h6>
                    <div class="card-body collapse" id="collapseTwo"  aria-labelledby="headingTwo" data-parent="#accordion">
                        @if($inactive_computers == [])
                            {{'NO INACTIVE COMPUTERS.........'}}
                        @else
                            <div class="col-md-12 offset-md-3">
                                <div class="form-group form-inline">
                                    <input id="search6" type="text" class="form-control"
                                           placeholder="Search......" style="width: 300px;">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table6">
                                    <thead>
                                    <tr>
                                        <th>Custodian</th>
                                        <th>Computer Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inactive_computers as $computer)
                                        <tr>
                                            <td>{!! $computer->custodian !!}</td>
                                            <td>{!! $computer->computer_name !!}</td>
                                            <td>
                                                <a href="{!!  url('Mac_addresses',$computer->id) !!}">
                                                <button class="btn btn-primary ml-5">Mac Address</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{!! url('revert_to_active_computers/'.$computer->id
                                                    ,$computer->department_id) !!}"
                                                   onclick="return isConfirm()">
                                                    <i class="fa fa-trash ml-5
                                       text-danger" data-toggle="tooltip" data-placement="top" title="Set active">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
