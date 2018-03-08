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
    return view('home');
});

Route::get('/login', 'LoginController@login')->name('login');
Route::get('/register', 'RegisterController@register')->name('register');
Route::get('/', 'BarangController@index')->name('home');
Route::get('/search', 'BarangController@search')->name('search');
Route::group(['middleware' => 'admin'], function () {
	Route::get('/add_product', 'BarangController@create')->name('create');
	Route::post('/add_product', 'BarangController@store')->name('store.barang');
	Route::get('/manage_product', 'KategoriController@index')->name('manage_product');
	Route::delete('/manage_product/{id_barang}', 'BarangController@destroy')->name('destroy');
	Route::get('/new-kategori', 'KategoriController@create')->name('createcat');
	Route::post('/new-kategori', 'KategoriController@store')->name('store');
	Route::delete('/new-kategori/{id}', 'KategoriController@destroy')->name('destroycat');
	Route::get('/edit_product/{id}', 'BarangController@edit')->name('get.update');
	Route::post('/edit_product/{id}', 'BarangController@update')->name('update');
	Route::get('/edit-kategori/{id}', 'KategoriController@edit')->name('edit');
	Route::post('/edit-kategori/{id}', 'KategoriController@update')->name('update.kat');
	Route::get('/orders', 'OrderController@home');
 });
Route::group(['middleware' => 'login'], function () {
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::post('/profile', 'ProfileController@store')->name('profile.store');
	Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
	Route::post('/profile/activate', 'ProfileController@activate')->name('profile.activate');
	Route::post('province/city','ProfileController@wilayah')->name('get.city');
});
Route::group(['middleware' => 'users'], function () {
	Route::get('/cart', 'CartController@index')->name('cart');
	Route::post('/{bagian}/{slug}/{slugbarang}', 'CartController@store')->name('cart.store');
	Route::post('/cart', 'CartController@update')->name('cart.update');
	Route::post('/cart/check', 'CartController@check')->name('cart.checked');
	Route::delete('/cart/{id}', 'CartController@destroy')->name('destroy.cart');
	Route::post('/payment/ongkir', 'OrderController@ongkir')->name('ongkir');
	Route::post('/cart/checkout', 'OrderController@index')->name('checkout');
});
Route::group([''],function(){
	Route::get('/{bagian}/{slug}/{slugbarang}','BarangController@show')->name('show');
	Route::get('/{bagian}','BarangController@show')->name('show_kat');
	Route::get('/{bagian}/{slug}','BarangController@show')->name('show_sub');
});

Auth::routes();
