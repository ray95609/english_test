@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($result as $key => $value)
            <p>{{$key.':'.$value}}</p>
        @endforeach

    </div>

@endsection
