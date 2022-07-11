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
   Route::get('index','testController@index')->name('english_test.index');
   Route::get('array','testController@array')->name('english_test.array');
   Route::get('session','testController@session')->name('english_test.session');
   Route::get('datetime','testController@datetime')->name('english_test.datetime');
   Route::get('string','testController@string')->name('english_test.string');
   Route::post('string/explode','testController@string_explode')->name('english_test.string_explode');



});


