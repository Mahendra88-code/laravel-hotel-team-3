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
Route::get('delete-kamar', 'LihatKamarController@deleteKamar')->name('delete_kamar');
Route::get('get-kamar', 'LihatKamarController@getKamar')->name('get_kamar');
Route::post('insert-kamar','LihatKamarController@insertKamar')->name('save_kamar');
Route::post('update-kamar', 'LihatKamarController@updateKamar')->name('edit_kamar');

Route::get('tipe-kamar', 'TipeKamarController@view')->name('tkamar');
Route::get('delete-tipe', 'TipeKamarController@deleteTipe')->name('delete_tipe');
Route::get('get-tipe', 'TipeKamarController@getTipe')->name('get_tipe');
Route::post('insert-tipe','TipeKamarController@insertTipe')->name('save_tipe');
Route::post('update-tipe', 'TipeKamarController@updateTipe')->name('edit_tipe');

Route::get('lihat-layanan', 'LihatLayananController@view')->name('llayanan');

Route::get('transaksi-kamar', 'TransaksiKamarController@view')->name('transkamar');
Route::get('get-transaksi-kamar', 'TransaksiKamarController@getTKamar')->name('getTKamar');

Route::get('transaksi-layanan', 'TransaksiLayananController@view')->name('translayanan');

Route::get('user-menegemnt', 'UserController@view')->name('user');

Route::get('tamu', 'TamuController@view')->name('tamu');