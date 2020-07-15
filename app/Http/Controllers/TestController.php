<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
	public function index(){
		echo "111";
	}
    public function getWxToken(){
    	$appid="wxdf6c4b67f0287f85";
    	$appsecret="7f77628443998e589be2f800c4041d65";
    	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
    	$cont=file_get_contents($url);
    	echo $cont;
    }

    public function getWxToken2(){
    	$appid="wxdf6c4b67f0287f85";
    	$appsecret="7f77628443998e589be2f800c4041d65";
    	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;


    	// 创建一个新cURL资源
		$ch = curl_init();

		// 设置URL和相应的选项
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//将返回结果通过变量接收

		// 抓取URL并把它传递给浏览器
		$response = curl_exec($ch);

		// 关闭cURL资源，并且释放系统资源
		curl_close($ch);

		echo $response;
    }


}
