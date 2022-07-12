<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


/**
 * @Notes 其實這題是要考你 AJAX 用 JS 渲染頁面 和 dom 操作，所以不必針對資料做刪除或變更
 * @User rogerlu
 * @Date 2022/7/12
 * @Time 下午 01:40
 */
class TestApiExampleController extends Controller
{

    public  $dataUrl = "https://jsonplaceholder.typicode.com/users";

    /**
     * @Notes 使者資訊列表
     * @User rogerlu
     * @Date 2022/7/12
     * @Time 下午 12:32
     * @return Application|Factory|View
     */
    public function UserList(){
        return view('TestApi.UserList');
    }


    /**
     * @Notes 抓取user data 簡單抓取
     * @User rogerlu
     * @Date 2022/7/12
     * @Time 下午 01:56
     * @return JsonResponse
     */
    public function TestApiGetUserData(): JsonResponse
    {
//        Session::forget('UserData');
        //檢查session 是否存過此資料，一般不會用 session 會使用 redis 做cache，暫時使用
        $sortUserData  = Session::get('UserData');
        if(!$sortUserData){
            $sortUserData = $this->getApiUserData();
        }
        return response()->json($sortUserData);
    }



    /**
     * @Notes 抓取 API 資料 順便一次把 前端需求整理好 例如:  1. first last name 2. 是否紅色手機  3. 大小寫名子 4. email 帶上link
     * @User rogerlu
     * @Date 2022/7/12
     * @Time 下午 02:49
     */
    protected function  getApiUserData(): array
    {

        $sortUserData = [];

        //傳統簡單抓取URL API資料方法，https://www.php.net/manual/zh/function.file-get-contents.php
        $userData = file_get_contents($this->dataUrl,false);
        //json decode 轉陣列
        $userDataInfo = json_decode($userData,true);

        if(!empty($userDataInfo)){
            //需求上說需照ID排序
            $sortUserData = collect($userDataInfo)->sortBy('id')->toArray();

            //處李 first last name 及 手機是否顯示紅色 及 處理好小寫名子 及 處理好 email link
            foreach($sortUserData as $key => $dataInfo){
                //切割name
                $nameArray = explode(' ',$dataInfo['name']);
                //陣列 $sortUserData 設定 first name
                $sortUserData[$key]['first_name'] = $nameArray[0]??"";
                //陣列 $sortUserData 設定 last name
                $sortUserData[$key]['last_name'] = $nameArray[1]??"";
                //陣列 $sortUserData 設定 lower_first_name
                $sortUserData[$key]['lower_first_name'] = strtolower($nameArray[0])??"";
                //陣列 $sortUserData 設定 lower_last_name
                $sortUserData[$key]['lower_last_name'] = strtolower($nameArray[1])??"";
                //判斷手機第一個字是1 顯示紅色標記
                $phoneFirstWord = substr($dataInfo['phone'],0,1);
                $sortUserData[$key]['is_red_phone'] = 0;
                if($phoneFirstWord=="1"){
                    $sortUserData[$key]['is_red_phone'] = 1;
                }

                //處理好小寫名子
                $sortUserData[$key]['lower_username'] = strtolower($dataInfo['username']);
                $sortUserData[$key]['lower_name']     = strtolower($dataInfo['name']);
                //組成 a tag 的 href ，可以參考 https://www.geeksforgeeks.org/how-to-create-mail-and-phone-link-in-html/
                //chrome 允許開啟 mail 可參考 https://steachs.com/archives/41530
                $mailToLinK = "mailto:{$dataInfo['email']}?subject=Mail to {$dataInfo['username']}";
                //處理好 email link
                $sortUserData[$key]['link_email'] = "<a href='{$mailToLinK}' target='_blank'>" . $dataInfo['email']  ."</a>";
            }

            //寫入session
            Session::put('UserData',$sortUserData);
        }

        return $sortUserData;
    }

}
