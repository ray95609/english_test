@extends('layouts.app')

@section('content')

    <div class="container">
        @if(Session::has('fail'))
            <div class="alert alert-info" role="alert">
                <strong>僅能輸入數字</strong>
            </div>
        @endif
        <form action="{{route('english_test.number_format')}}" method="POST">
            @csrf
            <span>您輸入的數字:</span>
            <input type="text" name="number" required>
            <button type="submit" class="btn btn-success">送出</button>
            <br><br>
            @if(Session::has('success'))
                <span>四捨五入:</span>
                <textarea readonly rows="1">{{$roundNumber}}</textarea>
                <br>
                <span>會計表示:</span>
                <textarea readonly rows="1">{{$thousandthsNumber}}</textarea>
            @endif
        </form>
    </div>

@endsection
