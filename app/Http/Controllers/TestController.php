<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

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

    public function getWxToken3(){
    	$appid="wxdf6c4b67f0287f85";
    	$appsecret="7f77628443998e589be2f800c4041d65";
    	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;

    	$client=new Client();
    	$response=$client->request('Get',$url);
    	$data=$response->getBody();
    	echo $data;
    }
    public function getAccessToken(){
    	$token=Str::random(32);
    	$data=[
    		'token'=>$token,
    		'expire_in'=>7200
    	];
    	echo json_encode($data);
    }

    public function hash1(){
        $data=[
            'name'=>'zhangsan',
            'email'=>'zhangsan@qq.com',
            'age'=>22
        ];
    }

    public function goods(Request $request){
        $goods_id=$request->get('id');
        echo "商品ID:".$goods_id;
    }

    public function aes1(){
        $data='Hello world';
        $method='AES-256-CBC';
        $key='1911api';
        $iv='aaaabbbbccccdddd';
        echo "原始数据: ".$data;echo "</br>";
        $enc_data=openssl_encrypt($data, $method, $key,OPENSSL_RAW_DATA,$iv);
        //echo openssl_error_string();die;
        echo "加密后的密文: ".$enc_data;echo "</br>";
        echo '<hr>';
        //解密
        $dec_data=openssl_decrypt($enc_data, $method, $key,OPENSSL_RAW_DATA,$iv);
        echo "解密数据: ".$dec_data;echo "</br>";
    }
    //对称
    public function dec(Request $request){
        $method='AES-256-CBC';
        $key='1911api';
        $iv='aaaabbbbccccdddd';
        $option=OPENSSL_RAW_DATA;

        //$content=file_get_contents("php://input");
        echo '<pre>';print_r($_POST);echo '</pre>';echo "</br>";; 
        //echo $content;die;
        $enc_data=base64_decode($_POST['data']);
        
        //解密
        $dec_data=openssl_decrypt($enc_data, $method, $key,$option,$iv);
        echo "解密数据: ". $dec_data;
    }
    //非对称加密
    public function rsa1(){
        $data="长江长江我是黄河";
        $content=file_get_contents(storage_path('keys/pub.key'));
        $pub_key=openssl_get_publickey($content);
        openssl_public_encrypt($data,$enc_data,$pub_key);

        //var_dump($enc_data);echo "</br>";

    }

    public function sign1(Request $request){
        $key="1911api";

        //接收数据
        $data=$request->get('data');
        $sign=$request->get('sign');    //接收到的签名
        $sign_str1=sha1($data.$key);
        if($sign_str1==$sign){
            echo "验签成功";
        }else{
            echo "验签失败";
        }

    }
    public function sign2(){
        $data="1911api";
        
    }
    public function return(){

    }
    public function notify(){

    }


}
