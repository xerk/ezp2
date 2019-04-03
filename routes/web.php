<?php

use Gloudemans\Shoppingcart\Facades\Cart;


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
    return view('vendor.ezp.landing-page');
})->name('landingPage');

Route::get('/welcome', function () {
    $config['center'] = 'Giza, Egypt';
    $config['zoom'] = '14';
    $config['map_height'] = '500px';
    $config['scrollwheel'] = false;

    GMaps::initialize($config);
    $map = GMaps::create_map();
    return view('welcome')->with('map', $map);
});

Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
Route::post('checkout-distributor', 'CheckoutController@distributor')->name('checkout.distributor');

Route::get('confirmation/{order}', 'ConfirmationController@index')->name('confirmation.index');

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart/{product}', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/shop', 'ProductController@index')->name('shop');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
