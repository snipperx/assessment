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

Route::post('/contacts/register','HomeController@register');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user_registration', 'HomeController@register')->name('user_registration');
Route::get('admin/routes', 'HomeController@index')->name('home');
Route::post('/users/{user}/edit', 'HomeController@registerUser');
Route::get('/balance/topUp', 'TopUpController@index');
Route::post('/balance/update','TopUpController@update');
Route::get('/manage/discounts', 'DiscountsController@index');
Route::post('manage/discounts/add_discount','DiscountsController@addDiscount');
Route::get('/manage/add_discounts', 'DiscountsController@discountIndex');
Route::get('/discounts/{discount}/edit', 'DiscountsController@discountedit');
Route::post('/manage/{discount}/update', 'DiscountsController@discountupdate');

Route::get('/manage/products', 'ProductsController@index');
Route::get('/manage/add_products', 'ProductsController@products');
Route::get('/products/{products}/edit', 'ProductsController@editproducts');
Route::post('/manage/addproducts', 'ProductsController@addnewProducts');
Route::post('/products/{product}/update', 'ProductsController@productupdate');

Route::get('/transactions/viewtransactions', 'TransactionController@index');

Route::get('/view/products', 'TransactionController@viewProducts');

Route::get('/product/addcart/{product}', 'TransactionController@addtocart');
//
Route::get('/view/basket', 'TransactionController@viewcart');

Route::post('/cart/checkout', 'TransactionController@checkout');

Route::get('/cart/manage/{cart}/delete', 'TransactionController@deletecheckout');


