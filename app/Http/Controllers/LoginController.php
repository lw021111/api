<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;
use App\Model\TokenModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    public function reg(){
    	$data=[
    		'username'=>request()->input('username'),
	    	'pwd'=>password_hash(request()->input('pwd'),PASSWORD_BCRYPT),
	    	'email'=>request()->input('email'),
	    	'create_time'=>time()
    	];
    	$info=Login::create($data);
    	if($info){
    		echo "注册成功";
    	}else{
    		echo "注册失败";
    	}
    }

    public function login(){
    	$username=request()->input('username');
	    $pwd=request()->input('pwd');
    	$info=Login::where(['username'=>$username])->first();
    	if ($info) {
    		//验证密码
    		if(password_verify($pwd,$info->pwd)){
    			//生成token
	    		$token=Str::random(32);
                $expire_seconds=3600;

                $data=[
                    'token'=>$token,
                    'uid'=>$info->user_id,
                    'expire_at'=>time()+$expire_seconds
                ];
                //入库
                $tid=TokenModel::insertGetId($data);

    			$response=[
	    			'error'=>0,
	    			'msg'=>'ok',
	    			'data'=>[
	    				'token'=>$token,
                        'expire_in'=>$expire_seconds
	    			]
	    		];
	    		
    		}else{
    			$response=[
	    			'error'=>500001,
	    			'msg'=>'密码错误'
	    		];
    		}
    		
    	}else{
    		$response=[
    			'error'=>400001,
    			'msg'=>'用户不存在'
    		];
    	}
    	return $response;
    }

    public function center(Request $request){
        //验证是否有token
        $token=$request->get('token');
        $info=TokenModel::where(['token'=>$token])->first();
        $user=Login::find($info->uid);
        $response=[
                'errno'=>0,
                'msg'=>'ok',
                'data'=>[
                    'user'=>$user
                ]
            ];
            return $response;
    }

    

}
