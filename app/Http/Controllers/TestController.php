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

    public function test1(){
        
        if(isset($_SERVER['HTTP_TOKEN'])){

        }else{
            echo "授权失败";die;
        }
        $uid=$_SERVER['HTTP_UID'];
        $token=$_SERVER['HTTP_TOKEN'];
        echo "uid".$uid;echo "</br>";
        echo "token".$token;echo "</br>";
    }
    public function return(){

    }

    public function notify(){}


    public function testpay(){
        return view("pay");
    }

    
    public function pay(Request $request)
    {
        $oid = $request->get('oid');
        //echo '订单ID： '. $oid;
        //根据订单查询到订单信息  订单号  订单金额

        //调用 支付宝支付接口

        // 1 请求参数
        $param2 = [
            'out_trade_no'      => time().mt_rand(11111,99999),
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
            'total_amount'      => 0.01,
            'subject'           => '1911-测试订单-'.Str::random(16),
        ];

        // 2 公共参数
        $param1 = [
            'app_id'        => '2016101400681555',
            'method'        => 'alipay.trade.page.pay',
            'return_url'    => 'http://api.lwei.xyz/return',   //同步通知地址
            'charset'       => 'utf-8',
            'sign_type'     => 'RSA2',
            'timestamp'     => date('Y-m-d H:i:s'),
            'version'       => '1.0',
            'notify_url'    => 'http://api.lwei.xyz/notify',   // 异步通知
            'biz_content'   => json_encode($param2),
        ];

        //echo '<pre>';print_r($param1);echo '</pre>';
        // 计算签名
        ksort($param1);
        //echo '<pre>';print_r($param1);echo '</pre>';

        $str = "";
        foreach($param1 as $k=>$v)
        {
            $str .= $k . '=' . $v . '&';
        }

        $str = rtrim($str,'&');     // 拼接待签名的字符串

        $sign = $this->sign($str);
        echo $sign;echo '<hr>';

        //沙箱测试地址
        $url = 'https://openapi.alipaydev.com/gateway.do?'.$str.'&sign='.urlencode($sign);
        return redirect($url);
        //echo $url;
    }


    protected function sign($data)
    {
//        if ($this->checkEmpty($this->rsaPrivateKeyFilePath)) {
//            $priKey = $this->rsaPrivateKey;
//
//            $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
//                wordwrap($priKey, 64, "\n", true) .
//                "\n-----END RSA PRIVATE KEY-----";
//        } else {
//            $priKey = file_get_contents($this->rsaPrivateKeyFilePath);
//            $res = openssl_get_privatekey($priKey);
//        }

        $priKey = file_get_contents(storage_path('keys/ali_priv.key'));
        $res = openssl_get_privatekey($priKey);
        var_dump($res);echo '<hr>';

        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');

        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        $sign = base64_encode($sign);
        return $sign;
    }


}
