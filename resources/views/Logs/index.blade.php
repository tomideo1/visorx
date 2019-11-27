@extends('layouts.visorx')
@section('content')
<div class="card-body">
    <ul class="list-group">
        <p>LOGS</p>
        @foreach($logs as $log)
            <li class="list-group-item">{{$log->logged_on_user}}</li>
            <li class="list-group-item">{{$log->used_data}}</li>
        @endforeach
    </ul>
</div>
    @endsection