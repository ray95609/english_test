<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class testController extends Controller
{

    public function index(){

        return view('english_test.index');

    }

    //考題1: 使用PHP程式請將變數拆解成Array
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

   //考題2: 使用PHP程式完成下列要求：目的是呈現對於session瞭解及運用
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

   //考題3: 延續考題2, 做時間加減運算
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


   //考題4: 請解釋底下這兩行Cron 指令所代表的意思?
   public function linux_Cron(){

        return view('english_test.php_Linux_Cron');

   }


   //考題5: 拆解Email取出@前的字串
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

    //考題6: PHP Number數字應用
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
    //考題7:  SQL資料庫操作
    public function SQL(){

        return view('english_test.php_SQL');

    }

    //考題8: JSON應用
    public function JSON(){

        Session::forget('success');

        return view('english_test.php_json');

    }

    public function JSON_decode(Request $request){

            if($request!=null){
                $json=$request->input('json_data');
                $json=json_decode($json,true);

                $erpkey=$json['DATA']['erpkey'];

                Session::put('success','轉換成功');
                return view('english_test.php_json',['erpkey'=>$erpkey]);

            }else{
                return redirect()->route('english_test.JSON')->with('fail','未取得任何資料');

            }

    }
    //考題9: PHP Array搜尋應用
    public function array_search(){
        Session::forget('success');
        Session::forget('fail');
        return view('english_test.php_array_search');

    }

    public function array_searching(Request $request){
        Session::forget('success');
        Session::forget('fail');
        if($request!=null){

            $dbData=[
                "A01KA029","A02KA032", "A03KA028","A01KA029001",
                "A01KA029002", "A01KA029003", "A01KA029004", "A01KA029005",
                "A02KA032001", "A02KA032002","A02KA032003", "A02KA032004",
                "A02KA032005", "A03KA028001","A03KA028002", "A03KA028003",
                "A03KA028004", "A03KA028005"
            ];

            $keyword=$request->input('keyword');

            $result='查無結果';

            if(in_array($keyword,$dbData)){
//                $key=array_search($keyword,$dbData);
//                $result=$dbData[$key];

                $result=array();
                foreach ($dbData as $key=>$value){
                    if(strstr($value,$keyword)==true){
                        array_push($result,$value);
                    }
                }

                Session::put('success','找到囉');

                return view('english_test.php_array_search',['result'=>$result]);
            }else{
                Session::put('fail','無搜尋內容');
                return view('english_test.php_array_search',['result'=>$result]);
            }

        }else{
            return redirect()->route('english_test.array_search')->with('fail','無搜尋內容');

        }

    }

    //考題10: Laravel Carbon時間套件應用
    public function Carbon(){

        $now=Carbon::now();
        $add14Month=$now->addMonth('14');
        $add14Month_year=$add14Month->format('Y');
        $add14Month_month=$add14Month->format('m');
        $add14Month_day=$add14Month->format('d');

        $result=[
            '現在'=>$now,
            '14個月後'=>$add14Month,
            '14個月後-年'=>$add14Month_year,
            '14個月後-月'=>$add14Month_month,
            '14個月後-日'=>$add14Month_day
        ];

        return view('english_test.php_Carbon',['result'=>$result]);

    }

    //考題11: Laravel API串接
    public function Laravel_API(){
        Session::forget('success');
        Session::forget('info');
        return view('english_test.index_Laravel_API');

    }
    //取得JSON DATA

    public function guzzle_data(){
        $client=new Client();
        $response=$client->get('https://jsonplaceholder.typicode.com/users');
        if($response!=null){
        $deresponse=json_decode($response->getBody()->getContents(),true);

        return $deresponse;
        }

    }

    public function ListData(){

        $deresponse=$this->guzzle_data();

        $idArray=[];
        $usernameArray=[];
        $nameArray=[];
        $cityArray=[];
        $emailArray=[];

        foreach ($deresponse as $key => $value){
            $id=$deresponse[$key]['id'];
            $idArray[]=$id;
            $userName=$deresponse[$key]['username'];
            $usernameArray[]=$userName;
            $name=$deresponse[$key]['name'];
            $nameArray[]=$name;
            $city=$deresponse[$key]['address']['city'];
            $cityArray[]=$city;
            $email=$deresponse[$key]['email'];
            $emailArray[]=$email;

        }
        $showDataArray=[
            'id'=>$idArray,
            'username'=>$usernameArray,
            'name'=>$nameArray,
            'city'=>$cityArray,
            'email'=>$emailArray,
        ];
        return $showDataArray;

    }

    public function parse(){



    }

    public function guzzle(){

//            $return=['code'=>'success'];
//
//            $client=new Client();
//            $response=$client->get('https://jsonplaceholder.typicode.com/users');
//            $deresponse=json_decode($response->getBody()->getContents(),true);
//            if($deresponse){
//
//                return response()->json($return);
//
//            }
        Session::forget('success');


            $deresponse=$this->guzzle_data();
            Session::put('success','獲取資料成功');

            $showDataArray=$this->ListData();

            return view('english_test.index_Laravel_API',
                ['deresponse'=>$deresponse,
                 'showDataArray'=>$showDataArray]);

    }

    public function detail($id){


        Session::forget('info');

        $guzzle_data=$this->guzzle_data();
        $deresponse=$this->guzzle_data();
        $showDataArray=$this->ListData();


        $firstName=explode(' ',$guzzle_data[$id]['name'])[0];
        $lastName=explode(' ',$guzzle_data[$id]['name'])[1];
        $company=$guzzle_data[$id]['company']['name'];
        $phone=$guzzle_data[$id]['phone'];


        Session::put('info','info資料獲取成功');

        $guzzleDataArray=[
            'firstName'=>$firstName,
            'lastName'=>$lastName,
            'company'=>$company,
            'phone'=>$phone,
        ];

        //dd($guzzleDataArray);
        return view('english_test.index_Laravel_API',
            ['guzzleData'=>$guzzle_data,
             'guzzleDataArray'=>$guzzleDataArray,
             'deresponse'=>$deresponse,
             'showDataArray'=>$showDataArray]);

    }



}
