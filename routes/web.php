<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[BerandaController::class,'tampil_data_produk_di_beranda'])->name('beranda');
//Beranda
Route::get('beranda',[BerandaController::class,'tampil_data_produk_di_beranda'])->name('beranda');

//Data Admin
Route::get('register_admin',[AdminController::class,'register_admin'])->name('register_admin');
Route::post('simpan_data_admin_baru',[AdminController::class,'simpan_data_admin_baru'])->name('simpan_data_admin_baru');
Route::get('login_admin',[AdminController::class,'login_admin'])->middleware('AdminLoggedIn');
Route::post('cek_login_admin',[AdminController::class,'cek_login_admin'])->name('cek_login_admin');
Route::get('dashboard_admin',[AdminController::class,'dashboard_admin'])->name('dashboard_admin');
Route::get('logout_admin',[AdminController::class,'logout_admin'])->name('logout_admin');

//Data Kategori
Route::get('tampil_data_kategori_oleh_admin',[KategoriController::class,'tampil_data_kategori_oleh_admin'])->name('tampil_data_kategori_oleh_admin');
Route::get('/cari_id_kategori/{id}',[KategoriController::class,'cari_id_kategori']);
Route::put('/simpan_perubahan_data_kategori_oleh_admin',[KategoriController::class,'simpan_perubahan_data_kategori_oleh_admin'])->name('kategori.simpan_perubahan_data');
Route::put('/hapus_data_kategori_oleh_admin',[KategoriController::class,'hapus_data_kategori_oleh_admin'])->name('kategori.hapus_data');
Route::get('tambah_data_kategori_oleh_admin',[KategoriController::class,'tambah_data_kategori_oleh_admin'])->name('tambah_data_kategori_oleh_admin');
Route::post('simpan_data_kategori_baru_oleh_admin',[KategoriController::class,'simpan_data_kategori_baru_oleh_admin'])->name('simpan_data_kategori_baru_oleh_admin');

//Data Satuan
Route::get('tampil_data_satuan_oleh_admin',[SatuanController::class,'tampil_data_satuan_oleh_admin'])->name('tampil_data_satuan_oleh_admin');
Route::get('/cari_id_satuan/{id}',[SatuanController::class,'cari_id_satuan']);
Route::put('/simpan_perubahan_data_satuan_oleh_admin',[SatuanController::class,'simpan_perubahan_data_satuan_oleh_admin'])->name('satuan.simpan_perubahan_data');
Route::put('/hapus_data_satuan_oleh_admin',[SatuanController::class,'hapus_data_satuan_oleh_admin'])->name('satuan.hapus_data');
Route::get('tambah_data_satuan_oleh_admin',[SatuanController::class,'tambah_data_satuan_oleh_admin'])->name('tambah_data_satuan_oleh_admin');
Route::post('simpan_data_satuan_baru_oleh_admin',[SatuanController::class,'simpan_data_satuan_baru_oleh_admin'])->name('simpan_data_satuan_baru_oleh_admin');

//Data Produk
Route::get('tampil_data_produk_oleh_admin',[ProdukController::class,'tampil_data_produk_oleh_admin'])->name('tampil_data_produk_oleh_admin');
Route::get('/cari_id_produk/{id}',[ProdukController::class,'cari_id_produk']);
Route::put('/simpan_perubahan_data_produk_oleh_admin',[ProdukController::class,'simpan_perubahan_data_produk_oleh_admin'])->name('produk.simpan_perubahan_data');
Route::put('/hapus_data_produk_oleh_admin',[ProdukController::class,'hapus_data_produk_oleh_admin'])->name('produk.hapus_data');
Route::post('/simpan_perubahan_data_foto_produk_oleh_admin',[ProdukController::class,'simpan_perubahan_data_foto_produk_oleh_admin'])->name('produk.simpan_perubahan_foto');

Route::get('tambah_data_produk_oleh_admin',[ProdukController::class,'tambah_data_produk_oleh_admin'])->name('tambah_data_produk_oleh_admin');
Route::post('simpan_data_produk_baru_oleh_admin',[ProdukController::class,'simpan_data_produk_baru_oleh_admin'])->name('simpan_data_produk_baru_oleh_admin');

//tambahan untuk data produk
Route::get('tampil_data_produk_versi_2_oleh_admin',[ProdukController::class,'tampil_data_produk_versi_2_oleh_admin'])->name('tampil_data_produk_versi_2_oleh_admin');
Route::get('/tampil_data_kategori',[ProdukController::class,'tampil_data_kategori'])->name('tampil_data_kategori');
Route::put('/simpan_perubahan_data_kategori_pada_data_produk_oleh_admin_data',[ProdukController::class,'simpan_perubahan_data_kategori_pada_data_produk_oleh_admin_data'])->name('produk.simpan_perubahan_data_kategori');