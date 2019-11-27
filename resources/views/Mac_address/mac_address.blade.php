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
        <h4 class="card-subtitle" style="color: #3B426C;">{!! $computer_name->custodian !!}&nbsp;&nbsp;Mac Adress</h4>
        <hr>
        <a href="{!! url('new_mac_address/'.$id,$computers_id) !!}"><button class="btn btn-primary btn-rounded"><i
                        class="fa
        fa-plus">&nbsp;</i>New Mac Address</button></a>
        <a href="{{url('Computers/'.$computers_id)}}" ><button class="btn btn-primary btn-rounded"><i
                        class="fa
        fa-arrow-circle-left"></i>&nbsp;&nbsp;
               Back to  Computers</button></a>
        <div class="row">
            <div class="col-md-9" id="accordion">
                <div class="card mt-3">
                    <h6 class="card-header" id="headingOne">Active
                        <span class="fa fa-caret-down float-lg-right"  data-toggle="collapse" data-target="#collapseOne"
                              aria-expanded="false" aria-controls="collapseOne" id="active">
                        </span>
                    </h6>
                    <div class="card-body collapse show"  id="collapseOne" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        @if($mac_addresses == [])
                            <p>No Mac Address Available for this Computer</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Mac::Address</th>
                                        <th>Channel</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mac_addresses as $mac)
                                        <tr>
                                            <td style="padding-top: 32px;">{!! $mac->mac_address !!}</td>
                                            @if($mac->channel == 1)
                                                <td>
                                                    Ethernet
                                                </td>
                                                <td>
                                                    <a href="{!! url('editMac_address/'.$mac->id,
                                                $mac->computer_id) !!}">
                                                        <i class="fa fa-edit ml-5 text-primary"></i>
                                                    </a>
                                                </td>
                                            @else
                                                <td>
                                                    Wifi
                                                </td>
                                                    <td>
                                                    <a href="{!! url('editMac_address/'.$mac->id,
                                                $mac->computer_id) !!}">
                                                        <i class="fa fa-edit ml-5 text-primary"></i>
                                                    </a>
                                                </td>
                                            @endif

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