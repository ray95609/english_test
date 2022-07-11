<?php

namespace App\Http\Controllers;

use DateTime;
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

      $time=new DateTime('now');
      $time=$time->format('Y-m-d H:i:s');
      //set session lifetime
      //也可以在config->session.php->lifetime中設定
      //'lifetime' => env('SESSION_LIFETIME', 180),
      ini_set('session.gc_maxlifetime',10800);

      $lifetime=ini_get('session.gc_maxlifetime');

       return view('english_test.php_session',['time'=>$time,'lifetime'=>$lifetime]);

   }

   public function datetime(){
        $now=new DateTime('now');
        $now=$now->format('Y-m-d');
        $tomorrow=new DateTime('+1 day');
        $tomorrow=$tomorrow->format('Y-m-d');
        $nextMonth=new DateTime('+1 month');
        $nextMonth=$nextMonth->format('Y-m-d');
        $nextYear=new DateTime('+1 year');
        $nextYear=$nextYear->format('Y-m-d');

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

   public function linux_Cron(){

        return view('english_test.php_Linux_Cron');

   }

    public function string(){

        Session::forget('success');

        return view('english_test.php_parse_email');

    }

    public function string_explode(Request $request){

        Session::forget('success');

        if($request!=null){
        $patten="/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
        $email=$request->input('email');
            if(preg_match($patten,$email)){

                $email=explode("@",$email);
                $email=$email[0];

                Session::put('success','獲取email成功');

                return view('english_test.php_parse_email',['email'=>$email]);
            }else{
               return redirect()->route('english_test.string')->with('fail','輸入非email');
                }
        }else{
            return redirect()->route('english_test.string')->with('fail','輸入非email');
        }
    }


    public function number(){

        Session::forget('success');

        return view('english_test.php_number');

    }

    public function numberFormat(Request $request){

        if($request!=null){
            $number=$request->input('number');

            if(is_numeric($number)){
                $roundNumber=round($number);
                $thousandthsNumber=number_format($number);

                Session::put('success','轉換成功');

                return view('english_test.php_number',['roundNumber'=>$roundNumber,'thousandthsNumber'=>$thousandthsNumber]);
            }else{
                return redirect()->route('english_test.number')->with('fail','僅能輸入數字');
            }

        }else{
            return redirect()->route('english_test.number')->with('fail','無輸入任何資料');
        }


    }

    public function SQL(){

        return view('english_test.php_SQL');

    }


}
