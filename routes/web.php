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
	return redirect('login');
});

//Login
Route::get('login', 'loginController@view')->name('login');
Route::post('post-login', 'loginController@postLogin')->name('postLogin');
Route::get('logout', 'loginController@logout')->name('logout');

//Dashboard
Route::get('dashboard', 'DashboardController@view')->name('dashboard');

//Kategori Layanan
Route::get('kategori-layanan', 'KategoriLayananController@view')->name('klayanan');

//Master Kamar
Route::get('lihat-kamar', 'LihatKamarController@view')->name('lkamar');
Route::get('delete-kamar', 'LihatKamarController@deleteKamar')->name('delete_kamar');
Route::get('get-kamar', 'LihatKamarController@getKamar')->name('get_kamar');
Route::post('insert-kamar','LihatKamarController@insertKamar')->name('save_kamar');
Route::post('update-kamar', 'LihatKamarController@updateKamar')->name('edit_kamar');

//Tipe Kamar
Route::get('tipe-kamar', 'TipeKamarController@view')->name('tkamar');
Route::get('delete-tipe', 'TipeKamarController@deleteTipe')->name('delete_tipe');
Route::get('get-tipe', 'TipeKamarController@getTipe')->name('get_tipe');
Route::post('insert-tipe','TipeKamarController@insertTipe')->name('save_tipe');
Route::post('update-tipe', 'TipeKamarController@updateTipe')->name('edit_tipe');

//Master Layanan
Route::get('lihat-layanan', 'LihatLayananController@view')->name('llayanan');
Route::post('tambah-layanan', 'LihatLayananController@insertLayanan')->name('save_layanan');
Route::post('edit-layanan', 'LihatLayananController@updateLayanan')->name('update_layanan');
Route::get('hapus-layanan', 'LihatLayananController@deleteLayanan')->name('delete_layanan');
Route::get('get-layanan', 'LihatLayananController@getLayanan')->name('get_layanan');

//Transaksi Kamar
Route::get('transaksi-kamar', 'TransaksiKamarController@view')->name('transkamar');
Route::get('get-transaksi-kamar', 'TransaksiKamarController@getTKamar')->name('getTKamar');

//Transaksi Layanan
Route::get('transaksi-layanan', 'TransaksiLayananController@view')->name('translayanan');
Route::get('get-transaksi-layanan', 'TransaksiLayananController@getTLayanan')->name('getTLayanan');

//Master User
Route::get('user-menegemnt', 'UserController@view')->name('user');
Route::get('get-user', 'UserController@readUser')->name('read_user');
Route::post('edit-user', 'UserController@updateUser')->name('update_user');
Route::post('tambah-user', 'UserController@createUser')->name('create_user');
Route::get('hapus-user', 'UserController@deleteUser')->name('delete_user');


//Master Tamu
Route::get('tamu', 'TamuController@view')->name('tamu');
Route::get('get-tamu', 'TamuController@readTamu')->name('read_tamu');
Route::post('edit-tamu', 'TamuController@updateTamu')->name('update_tamu');
Route::post('tambah-tamu', 'TamuController@createTamu')->name('create_tamu');
Route::get('hapus-tamu', 'TamuController@deleteTamu')->name('delete_tamu');

//Check In
Route::get('checkin', 'checkinController@view')->name('checkin');
Route::get('get-checkin', 'checkinController@readCheckin')->name('read_checkin');
Route::post('tambah-checkin', 'checkinController@createCheckin')->name('create_checkin');

//Check Out
Route::get('checkout', 'checkoutController@view')->name('checkout');
Route::get('get-checkout', 'checkoutController@readCheckout')->name('read_checkout');
Route::post('update-checkout', 'checkoutController@updateCheckout')->name('update_checkout');

//Tamu In House
Route::get('tamu-in-house', 'tamuinhouseController@view')->name('tamuinhouse');
Route::get('get-tamu-in-house', 'tamuinhouseController@readTransaksi')->name('read_tamuinhouse');
Route::post('edit-checkin', 'tamuinhouseController@updateTransaksi')->name('update_tamuinhouse');

//Pesan Layanan / Produk
Route::get('pesan-layanan', 'pesanlayananController@view')->name('pesanlayanan');
Route::get('get-pesan-layanan', 'pesanlayananController@readKamar')->name('get_pesanlayanan');
Route::get('list-pesanan', 'pesanlayananController@listPesanan')->name('list_pesanan');
Route::post('pesan', 'pesanlayananController@savePesan')->name('pesan');

//Pembersihan Kamar
Route::get('pembersihan-kamar', 'pembersihankamarController@view')->name('pembersihankamar');