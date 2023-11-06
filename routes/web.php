<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminArtikelController;
use App\Http\Controllers\Admin\AdminArtikelKategoriController;
use App\Http\Controllers\Admin\AdminGTKController;
use App\Http\Controllers\Admin\AdminGTKJabatanController;
use App\Http\Controllers\Admin\AdminSekolahController;

// General Controller
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

Route::prefix('admin')->name('admin.')->group(function() {
  Route::get('',[AdminController::class, 'beranda'])->name('index');
  
  Route::prefix('artikel')->name('artikel.')->group(function(){
    Route::get('',[AdminArtikelController::class, 'index'])->name('index');
    
    Route::prefix('kategori')->name('kategori.')->group(function(){
      Route::get('',[AdminArtikelKategoriController::class, 'index'])->name('index');
      Route::post('',[AdminArtikelKategoriController::class, 'simpan'])->name('simpan');
      Route::post('{kategori}',[AdminArtikelKategoriController::class, 'perbarui'])->name('perbarui');
      Route::delete('{kategori}',[AdminArtikelKategoriController::class, 'hapus'])->name('hapus');
    });
    
    Route::get('tambah',[AdminArtikelController::class, 'tambah'])->name('tambah');
    Route::post('',[AdminArtikelController::class, 'simpan'])->name('simpan');
    Route::get('ubah/{artikel}',[AdminArtikelController::class, 'ubah'])->name('ubah');
    Route::post('{artikel}',[AdminArtikelController::class, 'perbarui'])->name('perbarui');
    Route::delete('{artikel}',[AdminArtikelController::class, 'hapus'])->name('hapus');
  });

  Route::prefix('sekolah')->name('sekolah.')->group(function(){
    Route::get('',[AdminSekolahController::class, 'index'])->name('index');

    Route::name('simpan.')->group(function(){
      Route::post('umum',[AdminSekolahController::class, 'simpanUmum'])->name('umum');
      Route::post('sosmed',[AdminSekolahController::class, 'simpanSosmed'])->name('sosmed');
      Route::post('lokasi',[AdminSekolahController::class, 'simpanLokasi'])->name('lokasi');
    });
  });

  Route::prefix('gtk')->name('gtk.')->group(function(){
    Route::get('',[AdminGTKController::class, 'index'])->name('index');
    
    Route::prefix('jabatan')->name('jabatan.')->group(function(){
      Route::get('',[AdminGTKJabatanController::class, 'index'])->name('index');
      Route::post('',[AdminGTKJabatanController::class, 'simpan'])->name('simpan');
      Route::post('{jabatan}',[AdminGTKJabatanController::class, 'perbarui'])->name('perbarui');
      Route::delete('{jabatan}',[AdminGTKJabatanController::class, 'hapus'])->name('hapus');
    });

    Route::get('tambah',[AdminGTKController::class, 'tambah'])->name('tambah');
    Route::post('',[AdminGTKController::class, 'simpan'])->name('simpan');
    Route::get('ubah/{gtk}',[AdminGTKController::class, 'ubah'])->name('ubah');
    Route::post('{gtk}',[AdminGTKController::class, 'perbarui'])->name('perbarui');
    Route::delete('{gtk}',[AdminGTKController::class, 'hapus'])->name('hapus');
  });
});

Route::get('visi-misi-tujuan',[MainSekolahController::class, 'visi_misi_tujuan'])->name('visi_misi_tujuan');

Route::prefix('{kategori}')->name('artikel.')->group(function() {
  Route::get('',[MainArtikelController::class, 'beranda'])->name('index');
  Route::get('{artikel}',[MainArtikelController::class, 'tampil'])->name('tampil');
});
