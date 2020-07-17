<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;
class LoginController extends Controller
{
    public function reg(){
    	$data=[
    		'username'=>request()->input('username'),
	    	'pwd'=>request()->input('pwd'),
	    	'email'=>request()->input('email'),
	    	'create_time'=>time()
    	];

    	$info=Login::create($data);
    }

    public function login(){
    	$data=[
    		'username'=>request()->input('username'),
	    	'pwd'=>request()->input('pwd'),
    	];
    	$where=[
    		'username'=>$data['username'],
    		'pwd'=>$data['pwd']
    	];
    	$info=Login::where($where)->first();
    	if ($info) {
    		echo "登陆成功";
    	}else{
    		echo "登陆失败";
    	}
    }

}
