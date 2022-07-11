@extends('layouts.app')


@section('content')


    <table  class="table table-hover">
        <tr class="text-center">
            <th>題號</th>
            <th>題目</th>
        </tr>
        <tr  class="text-center" style="cursor: pointer">
            <td>1</td>
            <td ><a href="{{route('english_test.array')}}">使用PHP程式請將變數拆解成Array</a></td>
        </tr>
        <tr class="text-center" style="cursor: pointer">
            <td>2</td>
            <td><a href="{{route('english_test.session')}}">使用PHP程式完成下列要求：目的是呈現對於session瞭解及運用</a></td>
        </tr>
        <tr class="text-center" style="cursor: pointer">
            <td>3</td>
            <td><a href="{{route('english_test.datetime')}}">做時間加減運算</a></td>
        </tr>
        <tr class="text-center" style="cursor: pointer">
            <td>5</td>
            <td><a href="{{route('english_test.string')}}">拆解Email取出@前的字串</a></td>
        </tr>


    </table>


@endsection