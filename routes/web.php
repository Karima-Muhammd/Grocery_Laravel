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
Route::get('/','UserController@home')->name('home');
Route::get('/shop','UserController@shop')->name('shop');
Route::get('/check-out','UserController@checkout')->name('checkout');
Route::get('/register','UserController@register')->name('register');


//inc_admin routes
Route::middleware('IsAdmin')->prefix('/Admin')->group(function (){

    Route::get('/User','UserController@index')->name('User.index');
    Route::post('/User/{id}','UserController@show')->name('User.show');
    Route::get('/User/{id}','UserController@edit')->name('User.edit');
    Route::post('/User/edit/{id}','UserController@update')->name('User.update');
    Route::delete('/User/{id}','UserController@destroy')->name('User.delete');
    Route::resource('Order','OrderController');
    Route::post('/Order/save/{id}','OrderController@save')->name('Status.save');
    Route::get('/logout/','UserController@logout')->name('Admin.logout');
    Route::resource('order','OrderController');
    Route::get('/Panel',"UserController@index_admin")->name('admin_index');

});
Route::middleware('Not_Authenticated')->group(function (){
    Route::get('/login','UserController@login')->name('login');
    Route::post('/login','UserController@do_login')->name('Admin.do.login');
});
//admin dashboard

//category
Route::resource('category','CategoryController');
Route::resource('product','ProductController');
//guest
Route::get('/addCart/{id}','ProductController@AddToCart')->name('cart.add');
Route::get('/shopping-cart','ProductController@Viewcart')->name('cart.view');
Route::get('/RemoveItem/{id}','ProductController@RemoveItemCart')->name('cart.remove.item');
Route::get('/Billing-Details','ProductController@BillingDetails')->name('cart.Details');
Route::post('/Billing-Details-','UserController@store')->name('save.order');

Route::middleware('BillingDone')->group(function ()
{
    Route::get('checkout','CheckoutController@checkout')->name('credit-card');
    Route::post('checkout','CheckoutController@afterpayment')->name('checkout.credit-card');
});
