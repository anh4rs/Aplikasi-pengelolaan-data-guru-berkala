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

Route::namespace('API')->prefix('api')->name('API.')->group(function(){
    Route::prefix('golongan')->name('golongan.')->group(function(){
        Route::get('', 'GolonganController@get')->name('get');
        Route::get('{uuid}', 'GolonganController@find')->name('find');
        Route::post('', 'GolonganController@create')->name('create');
        Route::put('{uuid}', 'GolonganController@update')->name('update');
        Route::delete('{uuid}', 'GolonganController@delete')->name('delete');
        });
    Route::prefix('jabatan')->name('jabatan.')->group(function(){
        Route::get('', 'JabatanController@get')->name('get');
        Route::get('{uuid}', 'JabatanController@find')->name('find');
        Route::post('', 'JabatanController@create')->name('create');
        Route::put('{uuid}', 'JabatanController@update')->name('update');
        Route::delete('{uuid}', 'JabatanController@delete')->name('delete');
        });    
    Route::prefix('sekolah')->name('sekolah.')->group(function(){
        Route::get('', 'SekolahController@get')->name('get');
        Route::get('{uuid}', 'SekolahController@find')->name('find');
        Route::post('', 'SekolahController@create')->name('create');
        Route::put('{uuid}', 'SekolahController@update')->name('update');
        Route::delete('{uuid}', 'SekolahController@delete')->name('delete');
        });    
    Route::prefix('mapel')->name('mapel.')->group(function(){
        Route::get('', 'MPController@get')->name('get');
        Route::get('{uuid}', 'MPController@find')->name('find');
        Route::post('', 'MPController@create')->name('create');
        Route::put('{uuid}', 'MPController@update')->name('update');
        Route::delete('{uuid}', 'MPController@delete')->name('delete');
        });    

});

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

//halaman data Mata Pelajaran
Route::get('/mp/index', 'adminController@mpIndex')->name('mpIndex');