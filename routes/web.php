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

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('/product/new', 'ProductController@newProduct');
    Route::get('/products', 'ProductController@index');
    Route::get('/product/destroy/{id}', 'ProductController@destroy');
    Route::post('/product/save', 'ProductController@add');
});
 
Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('/', 'AccountController@index');
});

Route::get('/', 'MainController@index');


Route::get('/cart', 'CartController@showCart');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/addProduct/{productId}', 'CartController@addItem');
    Route::get('/removeItem/{productId}', 'CartController@removeItem');

    Route::post('/checkout', 'OrderController@checkout');
    Route::get('order/{orderId}', 'OrderController@viewOrder');
    Route::get('order', 'OrderController@index');
    Route::get('download/{orderId}/{filename}', 'OrderController@download');
});
