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
    Route::prefix('pejabat')->name('pejabat.')->group(function(){
        Route::get('', 'PejabatController@get')->name('get');
        Route::get('{uuid}', 'PejabatController@find')->name('find');
        Route::post('', 'PejabatController@create')->name('create');
        Route::put('{uuid}', 'PejabatController@update')->name('update');
        Route::delete('{uuid}', 'PejabatController@delete')->name('delete');
        });    
    Route::prefix('guru')->name('guru.')->group(function(){
        Route::get('', 'GuruController@get')->name('get');
        Route::get('{uuid}', 'GuruController@find')->name('find');
        Route::post('', 'GuruController@create')->name('create');
        Route::put('{uuid}', 'GuruController@update')->name('update');
        Route::delete('{uuid}', 'GuruController@delete')->name('delete');
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
    Route::prefix('diklat')->name('diklat.')->group(function(){
        Route::get('', 'DiklatController@get')->name('get');
        Route::get('{uuid}', 'DiklatController@find')->name('find');
        Route::post('', 'DiklatController@create')->name('create');
        Route::put('{uuid}', 'DiklatController@update')->name('update');
        Route::delete('{uuid}', 'DiklatController@delete')->name('delete');
        });  
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('', 'UserController@get')->name('get');
        Route::get('{uuid}', 'UserController@find')->name('find');
        Route::post('', 'UserController@create')->name('create');
        Route::put('{uuid}', 'UserController@update')->name('update');
        Route::delete('{uuid}', 'UserController@delete')->name('delete');
        });  
    Route::prefix('data')->name('data.')->group(function(){
        Route::get('', 'DataController@get')->name('get');
        Route::get('/getPending', 'DataController@getPending')->name('getPending');
        Route::get('{uuid}', 'DataController@find')->name('find');
        Route::post('', 'DataController@create')->name('create');
        Route::put('{uuid}', 'DataController@update')->name('update');
        Route::delete('{uuid}', 'DataController@delete')->name('delete');
        });  
    Route::prefix('gaji')->name('gaji.')->group(function(){
        Route::get('', 'GajiController@get')->name('get');
        Route::get('{uuid}', 'GajiController@find')->name('find');
        Route::post('', 'GajiController@create')->name('create');
        Route::put('{uuid}', 'GajiController@update')->name('update');
        Route::delete('{uuid}', 'GajiController@delete')->name('delete');
        });  
    Route::prefix('pendidikan')->name('pendidikan.')->group(function(){
        Route::get('', 'PendidikanController@get')->name('get');
        Route::get('/{id}', 'PendidikanController@getByGuru')->name('getByGuru');
        Route::get('{uuid}', 'PendidikanController@find')->name('find');
        Route::post('', 'PendidikanController@create')->name('create');
        Route::put('{uuid}', 'PendidikanController@update')->name('update');
        Route::delete('{uuid}', 'PendidikanController@delete')->name('delete');
        });  
    Route::prefix('sekolah')->name('sekolah.')->group(function(){
        Route::get('', 'SekolahController@get')->name('get');
        Route::get('{uuid}', 'SekolahController@find')->name('find');
        Route::post('', 'SekolahController@create')->name('create');
        Route::put('{uuid}', 'SekolahController@update')->name('update');
        Route::delete('{uuid}', 'SekolahController@delete')->name('delete');
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
Route::get('/guru/detail/{uuid}', 'adminController@guruDetail')->name('guruDetail');
Route::get('/guru/keseluruhanCetak', 'adminController@guruKeseluruhanCetak')->name('guruKeseluruhanCetak');
Route::get('/guru/filter', 'adminController@guruFilter')->name('guruFilter');
Route::post('/guru/filter', 'adminController@guruFilterCetak')->name('guruFilterCetak');



//halaman data Mata pejabat Struktural
Route::get('/pejabatStruktural/index', 'adminController@pejabatStrukturalIndex')->name('pejabatStrukturalIndex');
Route::get('/pejabatStruktural/Cetak', 'adminController@pejabatStrukturalCetak')->name('pejabatCetak');

//halaman data Mata berita
Route::get('/berita/index', 'adminController@beritaIndex')->name('beritaIndex');
Route::get('/berita/Cetak', 'adminController@beritaCetak')->name('beritaCetak');

//halaman data Mata Karyawan
Route::get('/karyawan/index', 'adminController@karyawanIndex')->name('karyawanIndex');
Route::get('/karyawan/Cetak', 'adminController@karyawanCetak')->name('karyawanCetak');

//halaman data Karyawan
Route::get('/permohonan/index', 'adminController@dataPermohonanIndex')->name('dataPermohonanIndex');
Route::get('/berkala/index', 'adminController@dataBerkalaIndex')->name('dataBerkalaIndex');
Route::get('/verifikasi/permohonan/{uuid}', 'adminController@dataBerkalaVerifikasi')->name('dataBerkalaVerifikasi');
Route::get('/permohonan/Cetak', 'adminController@permohonanCetak')->name('permohonanCetak');
Route::get('/permohonan/filter', 'adminController@permohonanFilter')->name('permohonanFilter');
Route::post('/permohonan/filter', 'adminController@permohonanFilterCetak')->name('permohonanFilterCetak');
Route::get('/dataBerkala/cetak', 'adminController@dataBerkalaCetak')->name('dataBerkalaCetak');

//gajihBerkala
Route::get('/gajihBerkala/index', 'adminController@gajihBerkalaIndex')->name('gajihBerkalaIndex');

//diklat
Route::get('/diklat/index', 'adminController@diklatIndex')->name('diklatIndex');
Route::get('/diklat/cetak', 'adminController@diklatCetak')->name('diklatCetak');
Route::get('/diklat/guru/filter', 'adminController@diklatguruFilter')->name('diklatGuruFilter');
Route::get('/diklat/guru/cetak', 'adminController@diklatGuruCetak')->name('diklatGuruCetak');


});

    Route::namespace('API')->prefix('api')->name('API.')->group(function(){
        Route::prefix('guru-sekolah')->name('guru-sekolah.')->group(function(){
            Route::get('', 'GuruController@getGuru')->name('get');
            Route::get('{uuid}', 'GuruController@find')->name('find');
            Route::post('', 'GuruController@create')->name('create');
            Route::put('{uuid}', 'GuruController@update')->name('update');
            Route::delete('{uuid}', 'GuruController@delete')->name('delete');
            });    
        Route::prefix('sekolah-data')->name('sekolah-data.')->group(function(){
            Route::get('', 'SekolahController@getSekolah')->name('get');
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
        Route::prefix('jabatan')->name('jabatan.')->group(function(){
            Route::get('', 'JabatanController@get')->name('get');
            Route::get('{uuid}', 'JabatanController@find')->name('find');
            Route::post('', 'JabatanController@create')->name('create');
            Route::put('{uuid}', 'JabatanController@update')->name('update');
            Route::delete('{uuid}', 'JabatanController@delete')->name('delete');
            });    
        Route::prefix('golongan')->name('golongan.')->group(function(){
            Route::get('', 'GolonganController@get')->name('get');
            Route::get('{uuid}', 'GolonganController@find')->name('find');
            Route::post('', 'GolonganController@create')->name('create');
            Route::put('{uuid}', 'GolonganController@update')->name('update');
            Route::delete('{uuid}', 'GolonganController@delete')->name('delete');
            });
        Route::prefix('data-sekolah')->name('data-sekolah.')->group(function(){
            Route::get('', 'DataController@getData')->name('get');
            Route::get('{uuid}', 'DataController@find')->name('find');
            Route::post('', 'DataController@create')->name('create');
            Route::put('/{id}', 'DataController@updateStatus')->name('updateStatus');
            Route::put('{uuid}', 'DataController@update')->name('update');
            Route::delete('{uuid}', 'DataController@delete')->name('delete');
            }); 
        Route::prefix('pejabat-sekolah')->name('pejabat-sekolah.')->group(function(){
            Route::get('', 'PejabatController@get')->name('get');
            Route::get('{uuid}', 'PejabatController@find')->name('find');
            Route::post('', 'PejabatController@create')->name('create');
            Route::put('{uuid}', 'PejabatController@update')->name('update');
            Route::delete('{uuid}', 'PejabatController@delete')->name('delete');
            });   
        Route::prefix('gaji-sekolah')->name('gaji-sekolah.')->group(function(){
            Route::get('', 'GajiController@get')->name('get');
            });  
        Route::prefix('pendidikan-sekolah')->name('pendidikan-sekolah.')->group(function(){
            Route::get('', 'PendidikanController@get')->name('get');
            Route::get('/{id}', 'PendidikanController@getByGuru')->name('getByGuru');
            Route::get('{uuid}', 'PendidikanController@find')->name('find');
            Route::post('', 'PendidikanController@create')->name('create');
            Route::put('{uuid}', 'PendidikanController@update')->name('update');
            Route::delete('{uuid}', 'PendidikanController@delete')->name('delete');
            });  
        Route::prefix('diklat_sekolah')->name('diklat_sekolah.')->group(function(){
              Route::get('', 'DiklatController@get')->name('getDiklat');
              Route::get('{uuid}', 'GuruController@diklat_get')->name('get');
              Route::post('', 'GuruController@diklat_create')->name('create');
              Route::delete('{uuid}', 'GuruController@diklat_delete')->name('delete');
            });

        Route::prefix('diklat')->name('diklat.')->group(function(){
            Route::get('', 'DiklatController@get')->name('get');
        });  
    });    

//middleware sekolah

    //beranda admin sekolah
    Route::get('/adminSekolah/index', 'adminSekolahController@index')->name('adminSekolahIndex');
    //beranda admin sekolah

    //data guru 
    Route::get('/adminSekolah/sekolah', 'adminSekolahController@sekolahIndex')->name('adminDataSekolahIndex');
    Route::get('adminSekolah/guru/detail/{uuid}', 'adminController@guruDetail')->name('adminSekolahGuruDetail');

    //data guru

    //data guru 
    Route::get('/adminSekolah/guru', 'adminSekolahController@guruIndex')->name('adminSekolahGuru');
    //data guru

    //data gajihBerkala 
    Route::get('/adminSekolah/dataBerkala', 'adminSekolahController@dataBerkalaIndex')->name('adminSekolahDataBerkala');
    Route::get('/adminSekolah/permohonan', 'adminSekolahController@permohonanTambah')->name('permohonanTambah');

    //data gajihBerkala

    //halaman inbox
    Route::get('/inbox/index', 'adminSekolahController@inboxIndex')->name('inboxIndex');
    Route::get('/inbox/detail/{id}', 'adminSekolahController@inboxDetail')->name('inboxDetail');
    Route::get('/inbox/delete/{id}', 'adminSekolahController@inboxDelete')->name('inboxDelete');


//middleware sekolah

Auth::routes();
Route::get('/', 'adminController@depan')->name('depan');
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/berita/all', 'adminController@beritaAll')->name('beritaAll');
Route::get('/berita/detail/{id}', 'adminController@beritaDetail')->name('beritaDetail');

 