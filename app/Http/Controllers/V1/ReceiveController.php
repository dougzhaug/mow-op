<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use EasyWeChat\Factory;

class ReceiveController extends Controller
{
    //
    public function auth()
    {
        $config = [
            'app_id'   => 'wx283587b496831502',//'开放平台第三方平台 APPID',
            'secret'   => 'd71efa5d2ec2d0b90544419df3b6485e',//'开放平台第三方平台 Secret',
            'token'    => 'openspen',//'开放平台第三方平台 Token',
            'aes_key'  => '04426065eb6795c0b414d282d52f03f6openspenvip',//'开放平台第三方平台 AES Key'
        ];

        $openPlatform = Factory::openPlatform($config);
        $openPlatform->getPreAuthorizationUrl('https://easywechat.com/callback'); // 传入回调URI即可
    }
}