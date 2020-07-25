<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use App\Model\TokenModel;
class VerifyAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token=$request->get('token');
        $key='s:token:blacklist';
        Redis::sismember($key,$token);
        if(empty($token)){
            $response=[
                'errno'=>400003,
                'msg'=>'请输入token'
            ];
            return response()->json($response);
        }
        //验证token是否有效
        $info=TokenModel::where(['token'=>$token])->first();
     
        if(empty($info)){
            $response=[
                'errno'=>400003,
                'msg'=>'授权失败'
            ];
            return response()->json($response);
        }else{
           $response=[
                'errno'=>400007,
                'msg'=>'欢迎来到个人中心'
            ];
            return response()->json($response); 
        }

        return $next($request);
    }
}
