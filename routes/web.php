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


Route::get('/', 'HomeController@index');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {
	Route::prefix('/home')->group(function(){
		Route::get('/','HomeController@index')->name('home');
	});

	Route::post('/select2_customer','Global_controller@select2_customer')->name('select2_customer');
	Route::post('/select2_produk','Global_controller@select2_produk')->name('select2_produk');
	Route::post('/get_harga','Global_controller@get_harga')->name('get_harga');

	Route::prefix('/produk')->group(function(){
		Route::get('/','MainC@index')->name('produk');
		Route::post('/json_produk','json@produk')->name('json_produk');
		Route::get('/create','Master_produk@create')->name('produk_create');
		Route::post('/create_action','Master_produk@create_action')->name('produk_create_action');
		Route::delete('/delete','Master_produk@delete')->name('produk_delete');

	});

	Route::prefix('/customer')->group(function(){
		Route::get('/','MainC@index')->name('customer');
		Route::post('/json_customer','json@customer')->name('json_customer');
		Route::get('/create','Master_customer@create')->name('customer_create');
		Route::post('/create_action','Master_customer@create_action')->name('master_create_action');
		Route::delete('/delete','Master_customer@delete')->name('customer_delete');

	});

	Route::prefix('/suplier')->group(function(){
		Route::get('/','MainC@index')->name('suplier');
		Route::post('/json_suplier','json@suplier')->name('json_suplier');
		Route::get('/create','Master_suplier@create')->name('suplier_create');
		Route::post('/create_action','Master_suplier@create_action')->name('suplier_create_action');
		Route::delete('/delete','Master_suplier@delete')->name('suplier_delete');

	});

	Route::prefix('/sales_order')->group(function(){
		Route::get('/','MainC@index')->name('sales_order');
		Route::post('/json_sales_order','json@sales_order')->name('json_sales_order');
		Route::get('/create','Sales_order@create')->name('sales_order_create');
		Route::post('/create_action','Sales_order@create_action')->name('sales_order_create_action');
		Route::delete('/delete','Sales_order@delete')->name('sales_order_delete');

	});
});
