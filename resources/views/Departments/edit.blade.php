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
    <h4 class="card-subtitle" style="color: #3B426C;">Departments</h4>
    <hr>
    <div class="col-md-6">
        <a href="{{route('Departments')}}" ><button class="btn btn-primary btn-rounded"><i class="fa
        fa-list"></i>&nbsp;&nbsp;
                Existing Departments</button></a>
        <div class="p-3"></div>
        <h4 class="card-subtitle mb-3" style="color: #3B426C;">Edit Department</h4>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{!! Route('updateDepartment',$department->id) !!}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="md-form input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text md-addon" id="material-addon1"> Name*</span>
                        </div>
                        <input type="text" class="form-control col-md-12" name="name"
                               value="{!! $department->name !!}">
                    </div>
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-4 waves-effect
                z-depth-0">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection