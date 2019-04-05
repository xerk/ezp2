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

Route::get('/map', function () {
    $config = array();
    $config['center'] = '30.013056, 31.208853';
    $config['zoom'] = '14';
    $config['map_height'] = '98vh';
    $config['scrollwheel'] = false;
    $config['directions'] = true;
    $config['directionsDraggable'] = true;

    GMaps::initialize($config);
    $marker = array();
    $marker['position'] = '30.012524, 31.207955';
    $marker['infowindow_content'] = 'Phrinta';
    GMaps::add_marker($marker);

    $marker['position'] = '30.007168, 31.218177';
    $marker['infowindow_content'] = 'Motawer';
    GMaps::add_marker($marker);

    $marker['position'] = '29.995498, 31.184804';
    $marker['infowindow_content'] = 'EZP Comapny';
    GMaps::add_marker($marker);


    $map = GMaps::create_map();

    return view('welcome')->with('map', $map);
})->name('map.index');

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
// Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('provider.login');
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('provider.login');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
