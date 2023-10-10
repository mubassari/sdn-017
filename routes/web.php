<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminArtikelController;
use App\Http\Controllers\Admin\AdminKategoriController;

// General Controller
use App\Http\Controllers\MainController;
use App\Http\Controllers\ArtikelController;

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
    Route::get('tambah',[AdminArtikelController::class, 'tambah'])->name('tambah');
    Route::post('',[AdminArtikelController::class, 'simpan'])->name('simpan');
    Route::get('ubah/{artikel}',[AdminArtikelController::class, 'ubah'])->name('ubah');
    Route::post('{artikel}',[AdminArtikelController::class, 'perbarui'])->name('perbarui');
    Route::delete('{artikel}',[AdminArtikelController::class, 'hapus'])->name('hapus');
  });
  Route::prefix('kategori')->name('kategori.')->group(function(){
    Route::get('',[AdminKategoriController::class, 'index'])->name('index');
    Route::post('',[AdminKategoriController::class, 'simpan'])->name('simpan');
    Route::post('{kategori}',[AdminKategoriController::class, 'perbarui'])->name('perbarui');
    Route::delete('{kategori}',[AdminKategoriController::class, 'hapus'])->name('hapus');
  });
});

Route::prefix('{kategori}')->name('artikel.')->group(function() {
  Route::get('',[ArtikelController::class, 'beranda'])->name('index');
  Route::get('{artikel}',[ArtikelController::class, 'tampil'])->name('tampil');
});
