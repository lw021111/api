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