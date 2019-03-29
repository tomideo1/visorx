<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VisorX</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    {{--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.css')}}" rel="stylesheet">
    <!-- visorx custom styles (optional) -->
    <link href="{{asset('css/visorx.css')}}" rel="stylesheet">
    <!-- visorx custom Javascript -->
    <script src="{{asset('js/data_converter.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{asset('js/mdb.js')}}"></script>
    <!-- Chart Js Javascript -->
    <script src="{{asset('js/modules/chart.js')}}"></script>
    <!-- Data Tables -->
    <script type="text/javascript" src="{{asset('js/addons/datatables.js')}}"></script>
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
<!-- Start your project here-->
<div style="height:100vh;" >
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-visorx">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class="navbar-brand" href="#"><img src="{{asset('img/logo.png')}}"></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="dboard-text nav-item">
                    <a class="nav-link" style="color: #3B426C;" href="#">Dashboard</a>
                </li>
            </ul>
            {!! Form::open(['route' => 'date_range','class' => 'form-inline'] ) !!}
                <div class="input-group mb-0">
                    <div class="input-group-append">
                        {{Form::label('start_date', 'From', ['class' => 'input-group-text'])}}
                    </div>
                    {{Form::date('start_date', Session::get('start_date'), ['class' => 'form-control', 'style'=>'background-color: #ffffff'])}}
                </div>&nbsp;
                <div class="input-group mb-0" >
                    <div class="input-group-prepend">
                        {{Form::label('end_date', 'To', ['class' => 'input-group-text'])}}
                    </div>
                        {{Form::date('end_date', Session::get('end_date'), ['class' => 'form-control', 'style'=>'background-color: #ffffff'])}}
                </div>&nbsp;
                         {{Form::submit('Update',['class' => 'btn btn-primary btn-rounded'])}}
            {!! Form::close() !!}
            <ul class="navbar-nav ml-auto nav-flex-icons ">
                <li class="user-link nav-item">
                    <a class="nav-link" style="color: #3B426C;" href="#">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item avatar dropdown">
                    <a class="nav-link  waves-effect waves-lightdropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{asset('img/user.png')}}" class="rounded-circle z-depth-0" alt="avatar image">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    {{--<div class="lds-facebook"><div></div><div></div><div>--}}
    <div class="container-fluid" id="main-body">
        <div class="row" >
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="float-left nav flex-column m-lg-5">
                        <li class="nav-item mt-3 p-md-0">
                            <a class="nav-link sidebar-icons" href="{{route('dashboard')}}">
                                <span data-feather="dashboard"> <img src="{{asset('img/dboard.png')}}"></span>
                                &nbsp;
                                Dashboard
                            </a>
                        </li>
                        <li class=" nav-item mt-3 p-md-0">
                            <a class="nav-link sidebar-icons">
                                <span data-feather="User"> <img src="{{asset('img/duser.png')}}"></span>
                                &nbsp;&nbsp;
                                Profile
                            </a>
                        </li>
                        <li class="nav-item mt-3 p-md-0">
                            <a class="dropdown-toggle nav-link sidebar-icons" href="#homeSubmenu"
                               data-toggle="collapse" aria-expanded="false">
                                <span data-feather="config"> <img src="{{asset('img/settings.png')}}"></span>
                                &nbsp;&nbsp;
                                Settings <span class="sr-only">(current)</span>
                            </a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li class="nav-item">
                                    <a class="nav-link sidebar-icons" href="{{route('Departments')}}">
                                        <span data-feather="department"> <i class="fa fa-building"></i></span>
                                        &nbsp;&nbsp;
                                        Departments <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link sidebar-icons" href="">--}}
                                        {{--<span data-feather="department"> <i class="fa fa-filter"></i></span>--}}
                                        {{--&nbsp;&nbsp;--}}
                                        {{--Filter <span class="sr-only">(current)</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}


                            </ul>
                        </li>
                        <li class=" nav-item mt-3 p-md-0">
                            <a class="nav-link sidebar-icons" href="{{route('Users')}}">
                                <span data-feather="department">
                                    <i class="fa fa-users-cog" style="color: #3C436D"></i>
                                </span>
                                &nbsp;&nbsp;
                                Users <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        {{--<li class=" nav-item mt-3 p-md-0">--}}
                            {{--<a class="nav-link sidebar-icons" href="">--}}
                                {{--<span data-feather="department">--}}
                                    {{--<i class="fa fa-bell" style="color: #3C436D"></i>--}}
                                {{--</span>--}}
                                {{--&nbsp;&nbsp;--}}
                                {{--Alert <span class="sr-only">(current)</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                    </ul>
                </div>
            </nav>
        </div>
        <div class="m-lg-auto p-lg-4"></div>
        <!-- <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div> -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 animated fadeIn delay-2s " id="main-body">
            <div class="mt-5 pt-3"></div>
            @yield('content')
        </main>
    </div>
</div>
<script src="{{asset('js/tables.js')}}"></script>
<script>
    // $(document).ready(function () {
    //     window.onload = function () {
    //         $('.spinner').fadeOut(500,function () {
    //             $('.spinner').remove();
    //         });
    //     }
    // });
</script>
<!--    --><?php
    $url = $_SERVER['REQUEST_URI'];
    header("Refresh:300; URL=\"".$url."\"");
//    ?>
</body>
</html>
