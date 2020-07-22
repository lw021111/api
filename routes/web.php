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
Route::get("/user/center","LoginController@center");//个人中心

Route::get("/goods","TestController@goods");

Route::get("/test1","TestController@test1")->middleware('count');