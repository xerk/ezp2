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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', 'ApiUserController@index');
    Route::get('/my-balance', 'Api\BalanceController@index');
    Route::post('/order', 'Api\OrderController@order');
    Route::post('/update-user', 'ApiUserController@update');
    Route::get('/my-order', 'Api\OrderController@index');
    Route::post('/logout', 'AuthController@logout');
});

Route::post('/login', 'Api\LoginController@login');
// Route::post('/register', 'AuthController@register');
Route::get('/products', 'ApiProductController@index');
Route::get('/companies', 'ApiHomeControllr@index');
Route::get('/featured', 'ApiHomeControllr@featured');
Route::get('/support', 'Api\SupportController@index');
Route::get('/slider', 'ApiHomeControllr@slider');
