<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;

class IndexController extends BaseController
{
    //
    public function index(Request $request)
    {
        var_dump($request->api);die;
    } 
}
