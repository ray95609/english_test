@extends('layouts.app')

@section('content')

    <div class="container">
        <p>A. 請下SQL語法得知總銷售金額(Sales欄位加總)</p>
        <p>B. 請下SQL語法模糊比對 Store_Name欄位中有“台北”字眼的 資料列</p>


        <p>A- SELECT SUM( Sales) AS SUM_Sales<br>
            FROM store_information;
        </p>

        <p>B- SELECT Store_Name,Sales,TXN_Date<br>
            FROM store_information<br>
            WHERE Store_Name LIKE "%台北%";
        </p>
    </div>

@endsection
