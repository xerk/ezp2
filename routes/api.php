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
    Route::post('/logout', 'AuthController@logout');
    Route::post('/order', 'ApiOrderController@order');
});

Route::post('/login', 'AuthController@login');
// Route::post('/register', 'AuthController@register');
Route::get('/products', 'ApiProductController@index');
Route::get('/companies', 'ApiHomeControllr@index');
Route::get('/featured', 'ApiHomeControllr@featured');
