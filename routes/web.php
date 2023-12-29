<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminArtikelController;
use App\Http\Controllers\Admin\AdminArtikelKategoriController;
use App\Http\Controllers\Admin\AdminGTKController;
use App\Http\Controllers\Admin\AdminGTKJabatanController;
use App\Http\Controllers\Admin\AdminSekolahController;
use App\Http\Controllers\Admin\AdminSekolahSambutanController;
use App\Http\Controllers\Admin\AdminSekolahVisiMisiTujuanController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminPengaturanController;

// General Controller
use App\Http\Controllers\Main\SitemapController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Main\MainArtikelController;
use App\Http\Controllers\Main\MainSekolahController;

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

Route::get('',[MainController::class, 'beranda'])->name('index');
Route::get('masuk',[MainController::class, 'masuk'])->name('masuk');
Route::post('masuk',[MainController::class, 'auth'])->name('auth');
Route::post('keluar',[MainController::class, 'keluar'])->name('keluar');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {
  Route::get('',[AdminController::class, 'beranda'])->name('index');
  
  Route::middleware('role:penulis')->prefix('artikel')->name('artikel.')->group(function(){
    Route::get('',[AdminArtikelController::class, 'index'])->name('index');
    
    Route::prefix('kategori')->name('kategori.')->group(function(){
      Route::get('',[AdminArtikelKategoriController::class, 'index'])->name('index');
      Route::post('',[AdminArtikelKategoriController::class, 'simpan'])->name('simpan');
      Route::put('{kategori}',[AdminArtikelKategoriController::class, 'perbarui'])->name('perbarui');
      Route::delete('{kategori}',[AdminArtikelKategoriController::class, 'hapus'])->name('hapus');
    });
    
    Route::get('tambah',[AdminArtikelController::class, 'tambah'])->name('tambah');
    Route::post('',[AdminArtikelController::class, 'simpan'])->name('simpan');
    Route::get('ubah/{artikel}',[AdminArtikelController::class, 'ubah'])->name('ubah');
    Route::put('{artikel}',[AdminArtikelController::class, 'perbarui'])->name('perbarui');
    Route::delete('{artikel}',[AdminArtikelController::class, 'hapus'])->name('hapus');
  });

  Route::middleware('role:admin')->group(function () {
    Route::prefix('sekolah')->name('sekolah.')->group(function(){
      Route::get('',[AdminSekolahController::class, 'index'])->name('index');

      Route::name('simpan.')->group(function(){
        Route::post('umum',[AdminSekolahController::class, 'simpanUmum'])->name('umum');
        Route::post('sosmed',[AdminSekolahController::class, 'simpanSosmed'])->name('sosmed');
        Route::post('lokasi',[AdminSekolahController::class, 'simpanLokasi'])->name('lokasi');
      });
    });

    Route::prefix("sambutan")->name('sambutan.')->group(function(){
      Route::get('',[AdminSekolahSambutanController::class, 'index'])->name('index');
      Route::post('simpan',[AdminSekolahSambutanController::class, 'simpan'])->name('simpan');
    });

    Route::prefix("visi-misi-tujuan")->name('visi_misi_tujuan.')->group(function(){
      Route::get('',[AdminSekolahVisiMisiTujuanController::class, 'index'])->name('index');
      Route::post('simpanVisi',[AdminSekolahVisiMisiTujuanController::class, 'simpanVisi'])->name('simpanVisi');
      Route::post('simpanMisi',[AdminSekolahVisiMisiTujuanController::class, 'simpanMisi'])->name('simpanMisi');
      Route::post('simpanTujuan',[AdminSekolahVisiMisiTujuanController::class, 'simpanTujuan'])->name('simpanTujuan');
    });
  });

  Route::middleware(['role:admin-gtk|admin'])->prefix('gtk')->name('gtk.')->group(function(){
    Route::get('',[AdminGTKController::class, 'index'])->name('index');
    
    Route::prefix('jabatan')->name('jabatan.')->group(function(){
      Route::get('',[AdminGTKJabatanController::class, 'index'])->name('index');
      Route::post('',[AdminGTKJabatanController::class, 'simpan'])->name('simpan');
      Route::put('{jabatan}',[AdminGTKJabatanController::class, 'perbarui'])->name('perbarui');
      Route::delete('{jabatan}',[AdminGTKJabatanController::class, 'hapus'])->name('hapus');
    });

    Route::get('tambah',[AdminGTKController::class, 'tambah'])->name('tambah');
    Route::post('',[AdminGTKController::class, 'simpan'])->name('simpan');
    Route::get('ubah/{gtk}',[AdminGTKController::class, 'ubah'])->name('ubah');
    Route::put('{gtk}',[AdminGTKController::class, 'perbarui'])->name('perbarui');
    Route::delete('{gtk}',[AdminGTKController::class, 'hapus'])->name('hapus');
  });

  Route::middleware('role:super-admin')->group(function () {
    Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
      Route::get('',[AdminPengaturanController::class, 'index'])->name('index');
      Route::post('artikel',[AdminPengaturanController::class, 'simpan_artikel'])->name('simpan_artikel');
    });

    Route::prefix('user')->name('user.')->group(function(){
      Route::get('',[AdminUserController::class, 'index'])->name('index');
      Route::get('tambah',[AdminUserController::class, 'tambah'])->name('tambah');
      Route::post('',[AdminUserController::class, 'simpan'])->name('simpan');
      Route::get('ubah/{user}',[AdminUserController::class, 'ubah'])->name('ubah');
      Route::put('{user}',[AdminUserController::class, 'perbarui'])->name('perbarui');
      Route::delete('{user}',[AdminUserController::class, 'hapus'])->name('hapus');
    });
  });
});

Route::get('visi-misi-tujuan',[MainSekolahController::class, 'visi_misi_tujuan'])->name('visi_misi_tujuan');
Route::get('sambutan',[MainSekolahController::class, 'sambutan'])->name('sambutan');
Route::get('gtk',[MainSekolahController::class, 'gtk'])->name('gtk');
Route::get('tentang',[MainSekolahController::class, 'tentang'])->name('tentang');
Route::get('cari/{cari}',[MainArtikelController::class, 'cari'])->name('cari');

Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::prefix('{kategori}')->name('artikel.')->group(function() {
  Route::get('',[MainArtikelController::class, 'beranda'])->name('index');
  Route::get('{artikel}',[MainArtikelController::class, 'tampil'])->name('tampil');
});
