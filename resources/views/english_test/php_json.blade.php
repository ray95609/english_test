@extends('layouts.app')

@section('content')

    <div class="container">
        <p>使用PHP解析底下的JSON , 並取出 erpkey</p>
        <button class="import btn btn-primary">輸入JSON</button>
        <br>
        <br>
        <form method="POST" action="{{route('english_test.JSON_decode')}}">
            @csrf
            <input type="hidden" value="" class="json_data" name="json_data">
            <button type="submit" class="sumbit btn btn-success">分析JSON</button>
        </form>
        @if(Session::has('success'))
            <span>分析後的erpkey:</span>
            <textarea readonly rows="1" style="width: 50%">{{$erpkey}}</textarea>
        @endif
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">


        $('.import').click(function () {
            alert(1)
            let json = {
                "STATUS": 200,
                "DATA": {
                    "ERROR": 0,
                    "MESSAGE": "Hello",
                    "SUCCESS": 1,
                    "erpkey": "2111LV11MD0Y_X_A01AR2111",
                    "EMAIL": "zzz@zzz.com"
                }
            }
            alert(2)
            let json_str = JSON.stringify(json)
            $('.json_data').val(json_str);
            let test = $('.json_data').val();

            alert(test);

        })


    </script>

@endsection
