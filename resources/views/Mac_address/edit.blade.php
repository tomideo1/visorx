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
    @if (Session::has('error'))
        <div class="col-md-12 alert  alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <h4 class="card-subtitle" style="color: #3B426C;">{!! $computer_name->custodian !!}&nbsp;&nbsp;Mac Adress</h4>
    <hr>
    <div class="col-md-6">
        <a href="{!!  url('Mac_addresses/'.$mac_address->computer_id,$computer_id->department_id) !!}" ><button
                    class="btn btn-primary
        btn-rounded"><i class="fa
        fa-list"></i>&nbsp;&nbsp;Existing Mac Addresses</button></a>
        <div class="p-3"></div>
        <h4 class="card-subtitle mb-3" style="color: #3B426C;">Edit Mac Address</h4>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{!! url('updateMac_address/'.$mac_address->id.'/'.$mac_address->computer_id,
                $computer_id->department_id)
                !!}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="md-form input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text md-addon" id="material-addon1">Mac Address*</span>
                        </div>
                        <input type="text" class="form-control col-md-12" name="mac_address" value="
                        {!! $mac_address->mac_address !!}">
                    </div>
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-4 waves-effect
                z-depth-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection