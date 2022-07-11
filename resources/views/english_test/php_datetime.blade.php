@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($timeArray as $key => $value)
        <h3>{{$key}}:{{$value}}</h3>
        @endforeach
    </div>

@endsection
