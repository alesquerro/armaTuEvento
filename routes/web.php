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
Route::post('registro', 'Auth\RegisterController@getRegister')->name('register');
Route::get('perfil', 'Front\UserController@showOptions');
Route::put('perfil', 'Auth\RegisterController@getRegisterEdit');
Route::get('olvidoContrasena', 'Auth\RegisterController@showOptionsReset')->name('password.email');
Route::post('olvidoContrasena', 'Auth\RegisterController@getRegister')->name('password.email');

Route::get('/','Front\StaticController@showIndex');
Route::get('FAQs','Front\StaticController@showFAQs');
Route::get('contacto','Front\StaticController@showContacto');
Route::get('contacto/{id}','Front\StaticController@showContactoProducto');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('carrito','Front\CartController@show');
Route::post('carrito/{id}','Front\CartController@add');
Route::post('vaciar_carrito','Front\CartController@clear');
Route::post('sacar_producto/{id}','Front\CartController@pop');
Route::post('guardar_carrito','Front\CartController@save')->middleware('auth');

Route::get('producto/{id}','Front\ProductController@show');
Route::get('listado','Front\ProductController@list');
Route::post('listado','Front\ProductController@list_post');
Route::get('listado/{tipo}/{tipo_evento}/{fecha}/{tipo_producto}/{texto}','Front\ProductController@listParameters');
Route::get('/','Front\ProductController@index');
Route::post('add_filter','Front\ProductController@add_filter');
Route::post('eliminar_filtro','Front\ProductController@remove_filter');
Route::post('limpiar_filtros','Front\ProductController@clean_filters');

Route::get('mis_compras','Front\UserController@show_purchases')->middleware('auth');
Route::get('mis_compras_confirmadas','Front\UserController@show_confirmed_purchases')->middleware('auth');
Route::get('mis_compras_anuladas','Front\UserController@show_rejected_purchases')->middleware('auth');
Route::post('add_favourites/{id}','Front\UserController@add_favourites')->middleware('auth');
Route::post('remove_favourites/{id}','Front\UserController@remove_favourites')->middleware('auth');
Route::post('confirmar_reserva/{id}','Front\UserController@user_reservation')->middleware('auth');
Route::post('rechazar_reserva/{id}','Front\UserController@user_reservation')->middleware('auth');

Route::get('Admin/listar_productos','Admin\ProductController@index')->middleware('IsAdmin');

Route::get('Admin/dashboard','Admin\StaticController@dashboard')->middleware('IsAdmin');

Route::post('Admin/Product','Admin\ProductController@edit')->middleware('IsAdmin');
Route::put('Admin/EditarProducto','Admin\ProductController@update')->middleware('IsAdmin');
Route::get('Admin/nuevoProducto','Admin\ProductController@create')->middleware('IsAdmin');
Route::put('Admin/Product','Admin\ProductController@store')->middleware('IsAdmin');
Route::get('Admin/listar_productos','Admin\ProductController@index')->middleware('IsAdmin');

Route::get('Admin/reservas','Admin\PurchaseController@reservation_list')->middleware('IsAdmin');
Route::get('Admin/reservas_confirmadas','Admin\PurchaseController@confirmed_reservation_list')->middleware('IsAdmin');
Route::get('Admin/reservas_anuladas','Admin\PurchaseController@rejected_reservation_list')->middleware('IsAdmin');
Route::post('Admin/reserva_admin/{id}','Admin\PurchaseController@reservation_admin')->middleware('IsAdmin');
Route::get('Admin/listar_usuarios', 'Admin\AdminController@indexUsers')->middleware('IsAdmin');
Route::get('Admin/modificar_usuario/{id}', 'Admin\AdminController@show')->middleware('IsAdmin');
Route::post('Admin/modificar_usuario/{id}', 'Admin\AdminController@update')->middleware('IsAdmin')->name('user.update');
