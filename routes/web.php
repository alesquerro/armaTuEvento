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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('registro', 'Auth\RegisterController@showOptions')->name('register');
//Route::get('registro', 'Auth\RegisterController@getRegister');

Route::get('/','Front\StaticController@showIndex');
// Route::get('/','Front\StaticController@showIndex');
Route::get('FAQs','Front\StaticController@showFAQs');
Route::get('contacto','Front\StaticController@showContacto');
Route::get('contacto/{id}','Front\StaticController@showContactoProducto');
Route::get('register','Front\StaticController@showOptions');

Route::get('carrito','Front\CartController@show');
Route::post('carrito/{id}','Front\CartController@add');
Route::post('vaciar_carrito','Front\CartController@clear');
Route::post('sacar_producto/{id}','Front\CartController@pop');
Route::post('guardar_carrito','Front\CartController@save')->middleware('auth');

Route::get('producto/{id}','Front\ProductController@show');
Route::get('listado','Front\ProductController@list');
Route::get('/','Front\ProductController@index');

Route::get('mis_compras','Front\UserController@show_purchases')->middleware('auth');
Route::post('add_favourites/{id}','Front\UserController@add_favourites')->middleware('auth');
Route::post('remove_favourites/{id}','Front\UserController@remove_favourites')->middleware('auth');

Route::get('Admin/listar_productos','Admin\ProductController@index');

Route::get('Admin/dashboard','Admin\StaticController@dashboard');
