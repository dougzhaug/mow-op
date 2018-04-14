<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use EasyWeChat\Factory;

class ReceiveController extends Controller
{
    //
    public $openPlatform;
    public function auth()
    {
        $config = [
            'app_id'   => 'wx283587b496831502',//'开放平台第三方平台 APPID',
            'secret'   => 'd71efa5d2ec2d0b90544419df3b6485e',//'开放平台第三方平台 Secret',
            'token'    => 'openspen',//'开放平台第三方平台 Token',
            'aes_key'  => '04426065eb6795c0b414d282d52f03f6openspenvip',//'开放平台第三方平台 AES Key'
        ];

        $this->openPlatform = Factory::openPlatform($config);
        $server = $this->openPlatform->server;

        return $server->serve();

    }

    public function bind()
    {
        $config = [
            'app_id'   => 'wx283587b496831502',//'开放平台第三方平台 APPID',
            'secret'   => 'd71efa5d2ec2d0b90544419df3b6485e',//'开放平台第三方平台 Secret',
            'token'    => 'openspen',//'开放平台第三方平台 Token',
            'aes_key'  => '04426065eb6795c0b414d282d52f03f6openspenvip',//'开放平台第三方平台 AES Key'
        ];

        $this->openPlatform = Factory::openPlatform($config);
        $url = $this->openPlatform->getPreAuthorizationUrl('http://open.spen.vip/bind/callback'); // 传入回调URI即可
        return view('V1/Receive/bind',['url'=>$url]);
    }

    public function bindCallback()
    {
        $config = [
            'app_id'   => 'wx283587b496831502',//'开放平台第三方平台 APPID',
            'secret'   => 'd71efa5d2ec2d0b90544419df3b6485e',//'开放平台第三方平台 Secret',
            'token'    => 'openspen',//'开放平台第三方平台 Token',
            'aes_key'  => '04426065eb6795c0b414d282d52f03f6openspenvip',//'开放平台第三方平台 AES Key'
        ];

        $this->openPlatform = Factory::openPlatform($config);
        $a = $this->openPlatform->handleAuthorize();
        dd($a);
    }
}
