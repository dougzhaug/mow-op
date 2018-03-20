<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//V1版本路由
Route::prefix('v1')->group(function () {
    Route::post('/', function () {

        echo 2;
        return view('welcome');
    });
    Route::get('/test','Admin\V1\IndexController@index');
});
