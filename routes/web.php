<?php

use Illuminate\Support\Facades\Route;

// Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminArtikelController;

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
  Route::prefix('artikel')->name('artikel.')->group(function(){
    Route::get('','AdminArtikelController@index')->name('index');
    Route::get('tambah','AdminArtikelController@tambah')->name('tambah');
    Route::post('','AdminArtikelController@simpan')->name('simpan');
    Route::get('ubah/{artikel}','AdminArtikelController@ubah')->name('ubah');
    Route::post('{artikel}','AdminArtikelController@perbarui')->name('perbarui');
    Route::delete('{artikel}','AdminArtikelController@hapus')->name('hapus');
  });
});
