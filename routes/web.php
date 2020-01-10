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
Route::group(['middleware' => 'admin'], function() {
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
    Route::prefix('guru')->name('guru.')->group(function(){
        Route::get('', 'GuruController@get')->name('get');
        Route::get('{uuid}', 'GuruController@find')->name('find');
        Route::post('', 'GuruController@create')->name('create');
        Route::put('{uuid}', 'GuruController@update')->name('update');
        Route::delete('{uuid}', 'GuruController@delete')->name('delete');
        });    
    Route::prefix('pejabat')->name('pejabat.')->group(function(){
        Route::get('', 'PejabatController@get')->name('get');
        Route::get('{uuid}', 'PejabatController@find')->name('find');
        Route::post('', 'PejabatController@create')->name('create');
        Route::put('{uuid}', 'PejabatController@update')->name('update');
        Route::delete('{uuid}', 'PejabatController@delete')->name('delete');
        });    
    Route::prefix('berita')->name('berita.')->group(function(){
        Route::get('', 'BeritaController@get')->name('get');
        Route::get('{uuid}', 'BeritaController@find')->name('find');
        Route::post('', 'BeritaController@create')->name('create');
        Route::put('{uuid}', 'BeritaController@update')->name('update');
        Route::delete('{uuid}', 'BeritaController@delete')->name('delete');
        });    
    Route::prefix('karyawan')->name('karyawan.')->group(function(){
        Route::get('', 'KaryawanController@get')->name('get');
        Route::get('{uuid}', 'KaryawanController@find')->name('find');
        Route::post('', 'KaryawanController@create')->name('create');
        Route::put('{uuid}', 'KaryawanController@update')->name('update');
        Route::delete('{uuid}', 'KaryawanController@delete')->name('delete');
        });  
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('', 'AdminController@get')->name('get');
        Route::get('{uuid}', 'AdminController@find')->name('find');
        Route::post('', 'AdminController@create')->name('create');
        Route::put('{uuid}', 'AdminController@update')->name('update');
        Route::delete('{uuid}', 'AdminController@delete')->name('delete');
        });  
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('', 'UserController@get')->name('get');
        Route::get('{uuid}', 'UserController@find')->name('find');
        Route::post('', 'UserController@create')->name('create');
        Route::put('{uuid}', 'UserController@update')->name('update');
        Route::delete('{uuid}', 'UserController@delete')->name('delete');
        });  
    Route::prefix('gaji')->name('gaji.')->group(function(){
        Route::get('', 'GajiController@get')->name('get');
        Route::get('{uuid}', 'GajiController@find')->name('find');
        Route::post('', 'GajiController@create')->name('create');
        Route::put('{uuid}', 'GajiController@update')->name('update');
        Route::delete('{uuid}', 'GajiController@delete')->name('delete');
        });  

});


Route::get('/admin/index', 'adminController@index')->name('adminIndex');

//halaman data golongan
Route::get('/golongan/index', 'adminController@golonganIndex')->name('golonganIndex');
Route::get('/golongan/cetak', 'adminController@golonganCetak')->name('golonganCetak');

//halaman data jabatan
Route::get('/jabatan/index', 'adminController@jabatanIndex')->name('jabatanIndex');
Route::get('/jabatan/cetak', 'adminController@jabatanCetak')->name('jabatanCetak');

//halaman data sekolah
Route::get('/sekolah/index', 'adminController@sekolahIndex')->name('sekolahIndex');
Route::get('/sekolah/keseluruhanCetak', 'adminController@sekolahKeseluruhanCetak')->name('sekolahKeseluruhanCetak');

//halaman data Mata Pelajaran
Route::get('/mp/index', 'adminController@mpIndex')->name('mpIndex');
Route::get('/mp/cetak', 'adminController@mpCetak')->name('mpCetak');


//halaman data Mata Pelajaran
Route::get('/guru/index', 'adminController@guruIndex')->name('guruIndex');
Route::get('/guru/keseluruhanCetak', 'adminController@guruKeseluruhanCetak')->name('guruKeseluruhanCetak');

//halaman data Mata Pelajaran
Route::get('/pejabatStruktural/index', 'adminController@pejabatStrukturalIndex')->name('pejabatStrukturalIndex');
Route::get('/pejabatStruktural/Cetak', 'adminController@pejabatStrukturalCetak')->name('pejabatCetak');

//halaman data Mata Pelajaran
Route::get('/berita/index', 'adminController@beritaIndex')->name('beritaIndex');
Route::get('/berita/Cetak', 'adminController@beritaCetak')->name('beritaCetak');
});

//middleware sekolah
    Route::get('/adminSekolah/index', 'adminSekolahController@index')->name('adminSekolahIndex');
//middleware sekolah

Auth::routes();
Route::get('/', 'adminController@depan')->name('depan');
Route::get('/berita/all', 'adminController@beritaAll')->name('beritaAll');
Route::get('/berita/detail/{id}', 'adminController@beritaDetail')->name('beritaDetail');
 