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

Route::get("/user/reg","LoginController@reg");
Route::post("/user/login","LoginController@login");
Route::get("/user/center","LoginController@center")->middleware('verify.token','count');//个人中心

Route::get("/goods","TestController@goods");

Route::get("/test1","TestController@test1");
Route::get("/test/aes1","TestController@aes1");
Route::any('/test/dec','TestController@dec');
Route::any('/test/rsa1','TestController@rsa1');
Route::any('/test/sign1','TestController@sign1');
Route::any('return','TestController@return');
Route::any('notify','TestController@notify');
Route::any('/test/pay','TestController@testpay');
Route::get('/pay','TestController@pay');

Route::prefix('class')->group(function(){
	Route::get('create','ClassesController@create');
	Route::post('createdo','ClassesController@createdo');
	Route::any('index','ClassesController@index');
	Route::any('del/{id}','ClassesController@del');
	Route::any('edit/{id}','ClassesController@edit');
	Route::any('update/{id}','ClassesController@update');
});

Route::prefix('student')->group(function(){
	Route::get('create','StudentController@create');
	Route::post('createdo','StudentController@createdo');
	Route::any('index','StudentController@index');
	Route::any('del/{id}','StudentController@del');
	Route::any('edit/{id}','StudentController@edit');
	Route::any('update/{id}','StudentController@update');
});
