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

    private function jwtCheck($request)
    {
        //验证jwt的有效性
        try{
            $Authorization = $request->header('Authorization');     //获取验证token
            list($Bearer,$token) = explode(' ',$Authorization);
            $privateKey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAnuxCb/SNGWCRWm2NbI1SPXNNLq9sp+fACIQUDOHvFW6vri0q
gFl+afnWPQfobjJK1qG68NV868zpjrRMc6HxOv6+7HIwwW4dMKFz7g6takSHS39r
wJbv9SmaP4zCWR2L2LQEG4b/WZr26nBvAEbInnUE97ZHspIGfLPhuV3TTwYWmnrI
bPyZTIOUhHtKLC5Eo3zEVl4A+lgtAgqoDouvyowEATlb/4J2rQGkcFNd4TkPRPtP
6AYrFxaHqCZ1zf3vMF42xM3h/lmgKpGi43turJkJDnSxKW98VfhrbPRRGXoKixSo
gvNwmS5xHgBjRywWZPwpzUidhBQ1wUtJ4k9eCQIDAQABAoIBAHb0g1pHo+Ht7X7R
Z71sHrXOe2RJfLxFdPEq49Msvoe9XRSzzA9cbYonrtvp8mmhjXEQh9xDAImDzQK7
JEqdWfJ9wi074BC5OnIvN5ZmOBnGB7tUOjRjBmPs6v9MfiC0Q/xF6pksODA7FT0w
QXXkhcBN+RTtxMb+FIr9HiVg/I015DFdI55YkWu92GGjVGC5RY76AxDJsq+Gtu+9
pBYv7az6fLk2lKQenhppoXXVR7yU7yTeyYuyU9Zx/NfekOlbeB+Gz5n1oFf7iuQt
ZFJKdJ4fKoVVXckPeytNwsUzzbKlgAlyQbwwMa5Crn5y+qTZJ/f1BGy5vjXoVY41
mVshDz0CgYEA0qYNjDz+r9m8+Hoa5EpURKHIO3FlC7oBgR29IReqn+Eb/GruzIT6
c6NlTKJKBXAopFfJIW8t2haSHLnfR8dSw+p+NK8Ha75sryMqq/EeEHdTwCjaaEwy
RXVarg8N3Ero1FEdCIy5yp90euuZhzwFd+K7xoiH33tq+euqLfXmrMsCgYEAwSNU
fQrG3J02XFWMF++8JeHXrUJHFBZI5FAzRJg+kKqcEjwR6GKDiHpRo5EG3m5GHRYh
nuJTG6iJiSG59aOd8/SZs7p+tZhzJlVfT7+mtgzhKssPsVrK9NjglwqWRG2Glp1m
zTh/OUziKCojYypP9k505/V3IO3BlNngYc1oefsCgYBp2mHyd/AwJAWvA4Uh9SwV
dQruvBPf6a+511zkFUV7pB5xILcxdR16IMDV2rPBudPiie6ba4gqEK+J2emW41X2
945GITJkdUOeWtiloLvP4HbomF7wjGGyv786unvnmIkZsE0br8PpS2m4H05+Q64n
yXs8z/0fU6C1SDSzdd9eMwKBgAWUJKub9RSIQfq2yd4jIZcih91MTctJvX9CxchU
cXIyS2HHdGj293+osNT9qmogW0wZyIzTUr04yAg6/ikXOcfDJ/FmEKTkK2dPDfq6
uXEGvDZFOUXRLo2V+h7CwoZld37AOyjwWdRo4Rtx5CXIIhkmOQA+OdusomvPQ0jv
6vWjAoGAK9O65mv6o5vAWwlgV546uQQkDVBI1gtgeUJdTIT+PRPFsxmftiSJrv6l
fUe6cmfE9GkMlzKMDYgOEvMI5WA1b/DSwQM1xxtpRqDtq2z3bLCz/EZ+UYyGc7Nq
3ZPFV4K+5PyeiqnaALr95v2Vu58ML7BVmr6660XLkkwNs0aCKe0=
-----END RSA PRIVATE KEY-----    
EOD;
            $publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAnuxCb/SNGWCRWm2NbI1S
PXNNLq9sp+fACIQUDOHvFW6vri0qgFl+afnWPQfobjJK1qG68NV868zpjrRMc6Hx
Ov6+7HIwwW4dMKFz7g6takSHS39rwJbv9SmaP4zCWR2L2LQEG4b/WZr26nBvAEbI
nnUE97ZHspIGfLPhuV3TTwYWmnrIbPyZTIOUhHtKLC5Eo3zEVl4A+lgtAgqoDouv
yowEATlb/4J2rQGkcFNd4TkPRPtP6AYrFxaHqCZ1zf3vMF42xM3h/lmgKpGi43tu
rJkJDnSxKW98VfhrbPRRGXoKixSogvNwmS5xHgBjRywWZPwpzUidhBQ1wUtJ4k9e
CQIDAQAB
-----END PUBLIC KEY-----
EOD;

//            $token = [
//                "iss" => "open.spen.com",
//                "aud" => "open.spen.com",
//                "iat" => 1356999524,
//                "nbf" => 1357000000
//            ];
//            //生成
//            $a = JWT::encode($token, $privateKey, 'RS256');
//var_dump($a);die;

            $payload = JWT::decode($token, $publicKey, array('RS256'));
//            var_dump($payload);die;
            $request['api'] = [
                'payload'=>(array)$payload,
            ];
        }catch (\Exception $e){
            var_dump($e->getCode());die;
            $msg = $e->getMessage();
            return response('11112', 404);
            return ['ddd'=>3333];
        }

    }
}
