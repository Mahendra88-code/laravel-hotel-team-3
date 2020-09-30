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

Route::get('/', function () {
	return redirect('dashboard');
});

Route::get('dashboard', 'DashboardController@view')->name('dashboard');
Route::get('kategori-layanan', 'KategoriLayananController@view')->name('klayanan');
Route::get('lihat-kamar', 'LihatKamarController@view')->name('lkamar');
Route::get('lihat-layanan', 'LihatLayananController@view')->name('llayanan');
Route::get('tipe-kamar', 'TipeKamarController@view')->name('tkamar');
Route::get('transaksi-kamar', 'TransaksiKamarController@view')->name('transkamar');
Route::get('transaksi-layanan', 'TransaksiLayananController@view')->name('translayanan');
Route::get('user-menegemnt', 'UserController@view')->name('user');
Route::get('tamu', 'TamuController@view')->name('tamu');

//Auth::routes();