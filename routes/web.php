<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('english_test.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'english_test'],function (){
    //目錄
   Route::get('index','testController@index')->name('english_test.index');
    //考題1: 使用PHP程式請將變數拆解成Array
   Route::get('array','testController@array')->name('english_test.array');
    //考題2: 使用PHP程式完成下列要求：目的是呈現對於session瞭解及運用
   Route::get('session','testController@session')->name('english_test.session');
    //考題3: 延續考題2, 做時間加減運算
   Route::get('datetime','testController@datetime')->name('english_test.datetime');
    //考題4: 請解釋底下這兩行Cron 指令所代表的意思?
   Route::get('linux_Cron','testController@linux_Cron')->name('english_test.linux_Cron');
    //考題5: 拆解Email取出@前的字串
   Route::get('string','testController@string')->name('english_test.string');
   Route::post('string/explode','testController@string_explode')->name('english_test.string_explode');
    //考題6: PHP Number數字應用
   Route::get('number','testController@number')->name('english_test.number');
   Route::post('number/format','testController@numberFormat')->name('english_test.number_format');
    //考題7:  SQL資料庫操作
   Route::get('SQL','testController@SQL')->name('english_test.SQL');
    //考題8: JSON應用
   Route::get('JSON','testController@JSON')->name('english_test.JSON');
   Route::post('JSON_decode','testController@JSON_decode')->name('english_test.JSON_decode');
    //考題9: PHP Array搜尋應用
   Route::get('array_search','testController@array_search')->name('english_test.array_search');
   Route::post('array_searching','testController@array_searching')->name('english_test.array_searching');
    //考題10: Laravel Carbon時間套件應用
   Route::get('Carbon','testController@Carbon')->name('english_test.Carbon');
    //考題11: Laravel API串接
    Route::get('index_Laravel_API','testController@Laravel_API')->name('english_test.Laravel_API');
    Route::get('index_Laravel_API/guzzle','testController@guzzle')->name('english_test.guzzle');
    Route::get('index_Laravel_API/detail/{id}}','testController@detail')->name('english_test.detail');


    //考題11: Laravel API串接 範例 : 網址後段 english_test/TestApiUserList
    //呈現主頁面
    Route::get('TestApiUserList','TestApiExampleController@UserList')->name('TestApiExample.UserList');

    //AJAX 取得 API DATA
    Route::get('TestApiGetUserData','TestApiExampleController@TestApiGetUserData')->name('TestApiExample.TestApiGetUserData');

});


