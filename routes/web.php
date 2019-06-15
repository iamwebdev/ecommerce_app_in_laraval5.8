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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
# For Showing Product List
Route::get('/products','CartController@getProducts');
# Show Cart
Route::get('/cart','CartController@showCart');
# Add item to Cart
Route::get('/add-to-cart/{id}', 'CartController@addToCart');
# Update Cart Item
Route::get('/update-cart', 'CartController@updateCart');
# Remove Cart Item
Route::get('/remove-cart-item/{id}', 'CartController@removeCartItem');
