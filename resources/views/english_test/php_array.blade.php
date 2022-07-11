@extends('layouts.app')

@section('content')

    <div class="container">
        <p>$string_src=”BSA01,BSA02,BSA03,BSA04,BSA05,BSA06,BSA07”;</p>
        @foreach($array_src as $key => $value)
            <p>{{$key.$value}}</p>
        @endforeach

    </div>

@endsection
