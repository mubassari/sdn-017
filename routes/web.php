<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminBeritaController;

// General Controller

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

Route::get('',function () {
  return \Inertia\Inertia::render('Index');
})->name('index');

Route::prefix('admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function() {
  Route::get('','AdminController@beranda')->name('beranda');
  Route::prefix('berita')->name('berita.')->group(function(){
    Route::get('','AdminBeritaController@index')->name('index');
    Route::get('tambah','AdminBeritaController@tambah')->name('tambah');
    Route::post('','AdminBeritaController@simpan')->name('simpan');
    Route::get('ubah/{berita}','AdminBeritaController@ubah')->name('ubah');
    Route::post('{berita}','AdminBeritaController@perbarui')->name('perbarui');
    Route::delete('{berita}','AdminBeritaController@hapus')->name('hapus');
  });
});
