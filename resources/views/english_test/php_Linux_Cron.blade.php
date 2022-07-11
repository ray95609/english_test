@extends('layouts.app')

@section('content')

    <div class="container">
        <p>請解釋底下這兩行Cron 指令所代表的意思?</p>
        <p>[user]$ crontab -l</p>
        <p>0 2 * * * php /var/www/html/mshop/releaseSession.php</p>

        <p>1-查看user查看所有cron排程的清單。</p>
        <p>2-每天凌晨2:00 執行 path:php /var/www/html/mshop/releaseSession.php 的程式</p>
    </div>

@endsection
