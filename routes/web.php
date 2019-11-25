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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/index', 'adminController@index')->name('adminIndex');

//halaman data golongan
Route::get('/golongan/index', 'adminController@golonganIndex')->name('golonganIndex');

//halaman data jabatan
Route::get('/jabatan/index', 'adminController@jabatanIndex')->name('jabatanIndex');

//halaman data sekolah
Route::get('/sekolah/index', 'adminController@sekolahIndex')->name('sekolahIndex');
