@extends('layouts.app')

@section('content')

    <div class="container">
        @if(Session::has('fail'))
            <div class="alert alert-info" role="alert">
                <strong>請輸入正確email格式</strong>
            </div>
        @endif
        <form action="{{route('english_test.string_explode')}}" method="POST">
           @csrf
            <span>請輸入E-mail:</span>
            <input type="email" name="email" required>
            <button type="submit" class="btn btn-success">送出</button>
            <br><br>
            @if(Session::has('success'))
            <span>您的註冊帳號:</span>
            <textarea readonly rows="1">{{$email}}</textarea>
            @endif
        </form>
    </div>

@endsection
