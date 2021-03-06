<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('receive/auth','V1\ReceiveController@auth');
Route::get('receive/bind','V1\ReceiveController@bind');
Route::get('bind/callback','V1\ReceiveController@callback');


