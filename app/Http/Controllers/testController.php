<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class testController extends Controller
{

    public function index(){

        return view('english_test.index');

    }


   public function array(){

       $string_src="BSA01,BSA02,BSA03,BSA04,BSA05,BSA06,BSA07";

       $array_src=explode(",",$string_src);


       $key=range(1,7);

       $array_src=array_combine($key,array_values($array_src));

       foreach ($array_src as &$value){

           $value='->'.$value;

       }


       return view('english_test.php_array',['array_src'=>$array_src]);

   }

   public function session(){

      $time=Carbon::now();

      //set session lifetime
      //也可以在config->session.php->lifetime中設定
      //'lifetime' => env('SESSION_LIFETIME', 180),
      ini_set('session.gc_maxlifetime',10800);

      $lifetime=ini_get('session.gc_maxlifetime');

       return view('english_test.php_session',['time'=>$time,'lifetime'=>$lifetime]);

   }

   public function datetime(){
        $now=Carbon::now();
        $tomorrow=$now->addDay()->format('Y-m-d');
        $nextMonth=$now->addMonth()->format('Y-m-d');
        $nextYear=$now->addYear()->format('Y-m-d');

        //設定時區
        //也可以到config->app.php->timezone中設定
        //'timezone' => 'Asia/Taipei',
        date_default_timezone_set('Asia/Taipei');

        $timezone=date_default_timezone_get();

        $timeArray=[
          '現在時間'=>$now,
          '現在時區'=>$timezone,
          '明天'=>$tomorrow,
          '下個月'=>$nextMonth,
          '明年'=>$nextYear
       ];

        return view('english_test.php_datetime',['timeArray'=>$timeArray]);
   }

    public function string(){

        Session::forget('success');

        return view('english_test.php_parse_email');

    }

    public function string_explode(Request $request){

        Session::forget('success');

        if($request!=null){

        $email=$request->input('email');
        $email=explode("@",$email);
        $email=$email[0];

        Session::put('success','獲取email成功');

        return view('english_test.php_parse_email',['email'=>$email]);
        }
    }


}
