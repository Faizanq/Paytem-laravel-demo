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


/*
* Token
*/
Route::get('/get-token','API\Token\TokenController@index');



Route::middleware('APIToken')->group(function () {

    Route::post('/login','API\Auth\AuthController@login');
});
