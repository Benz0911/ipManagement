<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user/auth', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    //ip
    Route::prefix('/ip')->group(function () {
        Route::post('/create/store', 'IpController@store')->name('ip.store');
        Route::patch('/update-ip/{ip}', 'IpController@update')->name('ip.update');
        Route::get('/get-ips', 'IpController@index')->name('ip.index');

        Route::get('/get-logs', 'LogController@index')->name('ip.index');
    });
});