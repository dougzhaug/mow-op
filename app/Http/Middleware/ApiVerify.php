<?php

namespace App\Http\Middleware;
use \Firebase\JWT\JWT;
use Closure;

class ApiVerify
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
        if (!in_array($request->getClientIp(), config('api.white_list')))
        {
            return response('Interface does not exist!', 404);
        }
        //验证jwt的有效性
        $Authorization = $request->header('Authorization');     //获取验证token
        list($Bearer,$token) = explode(' ',$Authorization);
        $key = "aksdfkasdkfkasdkfkaskdfkasdf";
//        $token = array(
//            "iss" => "http://abc.org",
//            "aud" => "http://abc.com",
//            "iat" => time(),
//            "nbf" => time()
//        );
//        $token = JWT::encode($token, $key);
        $payload = JWT::decode($token, $key, array('HS256'));
        $request['api'] = [
            'payload'=>(array)$payload,
        ];
//        dd((array)$payload);die;
        return $next($request);
    }
}
