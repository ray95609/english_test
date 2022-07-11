@extends('layouts.app')

@section('content')

<div class="container">
    @if(Session::has('fail'))
    <div class="alert alert-info" role="alert">
        <strong>未找到任何資料</strong>
    </div>
    @endif
    <form action="{{route('english_test.array_searching')}}" method="POST">
        @csrf
        <span>請輸入搜尋條件:</span>
        <input type="text" name="keyword" required>
        <button type="submit" class="btn btn-success">送出</button>
        <br><br>
        @if(Session::has('success'))
        <span>搜尋結果:</span>
        <textarea readonly rows="1" style="width: 50%;height: 300px;">
           @foreach($result as $key =>$value) {{$value}}@endforeach
        </textarea>
        @endif
        @if(Session::has('fail'))
            <span>搜尋結果:</span>
            <textarea readonly rows="1" style="width: 50%;height: 300px;">{{$result}}
        </textarea>
        @endif
    </form>
</div>

@endsection
