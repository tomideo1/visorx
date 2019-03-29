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
    <h4 class="card-subtitle" style="color: #3B426C;">{!! $department_name->name  !!}&nbsp;&nbsp;Computers</h4>
    <hr>
    <div class="col-md-6">
        <a href="{!!  url('Computers',$id) !!}" ><button class="btn btn-primary btn-rounded"><i class="fa
        fa-list"></i>&nbsp;&nbsp; Existing Computers</button></a>
        <a href="{{route('Departments')}}" ><button class="btn btn-primary btn-rounded"><i class="fa
        fa-arrow-circle-left"></i>&nbsp;&nbsp;
                Back to  Departments</button></a>
        <div class="p-3"></div>
        <h4 class="card-subtitle mb-3" style="color: #3B426C;">New Computer</h4>
        <div class="card">
            <div class="card-body">
                <form method="post" action="{!! Route('createComputer',$id) !!}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="POST">
                    <div class="md-form input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text md-addon" id="material-addon1">Computer Name*</span>
                        </div>
                        <input type="text" class="form-control col-md-12" name="computer_name">
                    </div>
                    <div class="md-form input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text md-addon" id="material-addon1">Custodian*</span>
                        </div>
                        <input type="text" class="form-control col-md-12" name="custodian">
                    </div>
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 col-md-4 waves-effect
                z-depth-0">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection