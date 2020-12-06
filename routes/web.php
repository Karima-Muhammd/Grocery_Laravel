<?php

use Illuminate\Support\Facades\Route;

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

//inc_client routes
Route::get('/','ClientController@home')->name('home');
Route::get('/shop','ClientController@shop')->name('shop');
Route::get('/check-out','ClientController@checkout')->name('checkout');
Route::get('/login','ClientController@login')->name('login');
Route::get('/register','ClientController@register')->name('register');


//inc_admin routes
Route::get('/admin','AdminController@dashboard')->name('dashboard');

//category
Route::resource('category','CategoryController');
Route::resource('product','ProductController');
Route::get('/addCart/{id}','ProductController@AddToCart')->name('cart.add');
Route::get('/shopping-cart','ProductController@Viewcart')->name('cart.view');

Route::resource('order','OrderController');
Route::get('/client/table','ClientController@show_all_products')->name('show_table_product');
//orders
Route::get('/Order/table','AdminController@show_orders')->name('show_table_orders');
