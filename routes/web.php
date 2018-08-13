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

Route::get('register', 'RegisterController@showOptions');

Route::get('/','Front\StaticController@showIndex');
// Route::get('/','Front\StaticController@showIndex');
Route::get('FAQs','Front\StaticController@showFAQs');
Route::get('contacto','Front\StaticController@showContacto');
Route::get('register','Front\StaticController@showOptions');

Route::get('carrito','Front\CartController@show');
Route::post('carrito/{id}','Front\CartController@add');
Route::post('vaciar_carrito','Front\CartController@clear');
Route::post('sacar_producto/{id}','Front\CartController@pop');

Route::get('producto/{id}','Front\ProductController@show');
Route::get('listado','Front\ProductController@list');
Route::get('/','Front\ProductController@index');

Route::get('Admin/','Admin\ProductController@index');
