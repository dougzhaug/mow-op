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

        $this->jwtCheck($request);

        return $next($request);
    }

    public function jwtCheck($request)
    {
        //验证jwt的有效性
        try{
            $Authorization = $request->header('Authorization');     //获取验证token
            list($Bearer,$token) = explode(' ',$Authorization);
            $key = "aksdfkasdkfkasdkfkaskdfkasdf1";

            $payload = JWT::decode($token, $key, array('HS256'));
            $request['api'] = [
                'payload'=>(array)$payload,
            ];
        }catch (\Exception $e){
//            var_dump($e->getCode());die;
//            $msg = $e->getMessage();
//            return response('11112', 404);
            return ['ddd'=>3333];
        }

    }
}
