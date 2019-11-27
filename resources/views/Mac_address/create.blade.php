@extends('layouts.visorx')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h4 class="card-subtitle" style="color: #3B426C;">{!! $computer_name->custodian !!}&nbsp;&nbsp;Mac Adress</h4>
    <hr>
    <div class="col-md-6">
        <a href="{!!  url('Mac_addresses/'.$id,$computers_id) !!}" ><button class="btn btn-primary btn-rounded">
                <i class="fa fa-list"></i>&nbsp;&nbsp;Existing Mac Addresses</button></a>
        <a href="{{url('Computers/'.$computers_id)}}" ><button class="btn btn-primary btn-rounded"><i
                        class="fa
        fa-arrow-circle-left"></i>&nbsp;&nbsp;
                Back to  Computers</button></a>
        <div class="p-3"></div>
        <h4 class="card-subtitle mb-3" style="color: #3B426C;">New Mac Address</h4>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{!! url('createMac_address/'.$id,$computers_id) !!}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="POST">
                    <div class="md-form input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text md-addon" id="material-addon1">Mac Address</span>
                        </div>
                        <input type="text" class="form-control col-md-12" name="mac_address">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Channel</label>
                        </div>
                        <select class="browser-default custom-select col-md-12" name="channel" id="inputGroupSelect01">
                            <option value="1">Ethernet</option>
                            <option value="2">Wifi</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-4 waves-effect
                z-depth-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endsection