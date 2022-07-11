@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>當前時間:{{$time}}</h3>
        <h3>Session存活時間:{{$lifetime/60/60}}小時</h3>

    </div>


@endsection
