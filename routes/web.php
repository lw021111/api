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
    return view('welcome');
});
Route::any("/getWxToken","TestController@getWxToken");
Route::any("/getWxToken2","TestController@getWxToken2");
Route::any("/getWxToken3","TestController@getWxToken3");
Route::any("/getAccessToken","TestController@getAccessToken");
Route::any("/user/info","TestController@userInfo");
Route::any("/test2","TestController@test2");

Route::get("/test/hash1","TestController@hash1");

Route::post("/user/reg","LoginController@reg");
Route::post("/user/login","LoginController@login");
Route::get("/user/center","LoginController@center")->middleware('verify.token','count');//个人中心

Route::get("/goods","TestController@goods");

Route::get("/test1","TestController@test1");
Route::get("/test/aes1","TestController@aes1");
Route::any('/test/dec','TestController@dec');
Route::any('/test/rsa1','TestController@rsa1');
Route::any('/test/sign1','TestController@sign1');
<<<<<<< HEAD
Route::any('return','TestController@return');
Route::any('notify','TestController@notify');

=======
Route::any('/test/pay','TestController@testpay');
Route::get('/pay','TestController@pay');
>>>>>>> 支付宝支付
