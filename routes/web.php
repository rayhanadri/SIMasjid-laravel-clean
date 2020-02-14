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

// basic route login,register,reset-password
Auth::routes();
Route::view('/after_register', 'auth.after_register')->name('afterRegister');

//pakai middleware auth
Route::middleware('auth')->group(function () {

    //route home
    Route::get('/', 'HomeController@index')->name('home');
    // group untuk anggota aktif
    Route::middleware('CheckStatus')->group(function () {
        Route::get('anggota', 'Anggota\AnggotaController@index')->name('anggotaIndex');

        // Route::get('anggota', 'Anggota\AnggotaController@dasbor')->name('anggotaDasbor');
        //route keanggotaan
        Route::get('anggota', 'Anggota\AnggotaController@index')->name('anggotaIndex');
        Route::get('anggota/detail/{id}', 'Anggota\AnggotaController@getDetail')->name('anggotaDetail');
        //edit, delete anggota
        Route::post('anggota/delete', 'Anggota\AnggotaController@delete')->name('anggotaDelete');
        Route::post('anggota/edit', 'Anggota\AnggotaController@edit')->name('anggotaEdit');

        //verifikasi anggota
        Route::get('anggota/verifikasi', 'Anggota\VerifikasiController@index')->name('anggotaIndexVerifikasi');
        Route::post('anggota/verifikasi/tolak', 'Anggota\VerifikasiController@tolak')->name('anggotaTolakVerif');
        Route::post('anggota/verifikasi/terima', 'Anggota\VerifikasiController@terima')->name('anggotaTerimaVerif');

        //anggota pengelola aset
        Route::get('anggota/pengelola-aset', 'Anggota\PengelolaAsetController@index')->name('anggotaPengelolaAset');
        Route::post('anggota/pengelola-aset/delete', 'Anggota\PengelolaAsetController@delete')->name('anggotaPengelolaAsetDelete');
        Route::post('anggota/pengelola-aset/add', 'Anggota\PengelolaAsetController@create')->name('anggotaPengelolaAsetCreate');

        //route aset
        Route::get('aset', 'Aset\AsetController@index')->name('asetIndex');
        Route::get('aset/detail/{id}', 'Aset\AsetController@detail')->name('asetDetail');
        Route::post('aset/update', 'Aset\AsetController@update')->name('asetUpdate');
        // Route::get('aset/testing', 'Aset\AsetController@testing')->name('asetTesting');

        //route aset tracking
        Route::get('aset/tracking', 'Aset\TrackingController@tracking')->name('asetTracking');
        Route::get('aset/tracking_hasil', 'Aset\TrackingController@trackingHasil')->name('asetTrackingHasil');

        //route aset pencatatan
        Route::get('aset/create', 'Aset\PencatatanController@create')->name('asetCreate');
        Route::post('aset/create_hasil', 'Aset\PencatatanController@createHasil')->name('asetCreateHasil');
        
        //route aset peminjaman
        Route::get('aset/peminjaman/create', 'Aset\PeminjamanController@createForm')->name('asetPeminjamanCreate');
        Route::post('aset/peminjaman/create', 'Aset\PeminjamanController@create')->name('asetPeminjamanCreateHasil');
        Route::post('aset/peminjaman/terima', 'Aset\PeminjamanController@terima')->name('asetPeminjamanTerimaVerif');
        Route::post('aset/peminjaman/tolak', 'Aset\PeminjamanController@tolak')->name('asetPeminjamanTolakVerif');
        Route::post('aset/peminjaman/selesai', 'Aset\PeminjamanController@selesai')->name('asetPeminjamanSelesai');
        Route::get('aset/peminjaman/verifikasi', 'Aset\PeminjamanController@indexVerifikasi')->name('asetPeminjamanIndexVerifikasi');
        Route::get('aset/peminjaman/ditolak', 'Aset\PeminjamanController@indexDitolak')->name('asetPeminjamanIndexDitolak');
        Route::get('aset/peminjaman/', 'Aset\PeminjamanController@indexBerjalan')->name('asetPeminjamanIndexBerjalan');
        Route::get('aset/peminjaman/selesai', 'Aset\PeminjamanController@indexSelesai')->name('asetPeminjamanIndexSelesai');
        
        
        //return JSON list
        Route::get('aset/get_json/{id}', 'Aset\AsetController@getAsetWhere')->name('asetJSON');
        Route::post('read_notif_json', 'NotifikasiController@read')->name('notifReadJSON');

        //route data master
        Route::get('aset/master', 'Aset\MasterController@indexKategori')->name('masterIndexKategori');
        Route::post('aset/master/kategori/create', 'Aset\MasterController@createKategori')->name('masterKategoriCreate');
        Route::post('aset/master/kategori/update', 'Aset\MasterController@updateKategori')->name('masterKategoriUpdate');
        Route::post('aset/master/kategori/delete', 'Aset\MasterController@deleteKategori')->name('masterKategoriDelete');
        Route::get('aset/master/lokasi', 'Aset\MasterController@indexLokasi')->name('masterIndexLokasi');
        Route::post('aset/master/lokasi/create', 'Aset\MasterController@createLokasi')->name('masterLokasiCreate');
        Route::post('aset/master/lokasi/update', 'Aset\MasterController@updateLokasi')->name('masterLokasiUpdate');
        Route::post('aset/master/lokasi/delete', 'Aset\MasterController@deleteLokasi')->name('masterLokasiDelete');

        //route usulan pengadaan
        Route::get('aset/pengadaan/usulan/create', 'Aset\Pengadaan\PengadaanController@createForm')->name('usulanCreateForm');
        Route::post('aset/pengadaan/usulan/create', 'Aset\Pengadaan\PengadaanController@create')->name('usulanCreate');
        Route::post('aset/pengadaan/usulan/update', 'Aset\Usulan\UsulanController@update')->name('usulanUpdate');
        Route::post('aset/pengadaan/usulan/edit', 'Aset\Usulan\UsulanController@edit')->name('usulanEdit');
        Route::get('aset/pengadaan/usulan/detail/{id}', 'Aset\Pengadaan\PengadaanController@detail_usulan')->name('usulanDetail');

        // //route rencana pengadaan
        // Route::get('aset/rencana', 'Aset\Rencana\RencanaController@index')->name('rencanaTerdaftar');
        // Route::post('aset/pengadaan/rencana/create', 'Aset\Rencana\RencanaController@create')->name('rencanaCreate');
        // Route::post('aset/pengadaan/rencana/update', 'Aset\Rencana\RencanaController@update')->name('rencanaUpdate');
        // Route::get('aset/pengadaan/rencana/detail/{id}', 'Aset\Rencana\RencanaController@detail')->name('rencanaDetail');

        //route pengadaan
        Route::get('aset/pengadaan', 'Aset\Pengadaan\PengadaanController@index')->name('pengadaanIndex');
        Route::post('aset/pengadaan/create', 'Aset\Pengadaan\PengadaanController@create')->name('pengadaanCreate');
        Route::post('aset/pengadaan/update', 'Aset\Pengadaan\PengadaanController@update')->name('pengadaanUpdate');
        Route::post('aset/pengadaan/edit', 'Aset\Pengadaan\PengadaanController@edit')->name('pengadaanEdit');
        Route::get('aset/pengadaan/detail/{id}', 'Aset\Pengadaan\PengadaanController@detail')->name('pengadaanDetail');

        //route inventaris
        // Route::get('aset/inventaris', 'Aset\Inventaris\InventarisController@index')->name('inventarisIndex');
        // Route::get('aset/inventaris/create', 'Aset\Inventaris\InventarisController@createForm')->name('inventarisCreateForm');
        // Route::post('aset/inventaris/create', 'Aset\Inventaris\InventarisController@create')->name('inventarisCreate');
        // Route::get('aset/inventaris/detail/{id}', 'Aset\Inventaris\InventarisController@detail')->name('inventarisDetail');
        // Route::post('aset/inventaris/update', 'Aset\Inventaris\InventarisController@update')->name('inventarisUpdate');
        // Route::post('aset/inventaris/delete', 'Aset\Inventaris\InventarisController@delete')->name('inventarisDelete');
        // Route::post('aset/inventaris/edit', 'Aset\Inventaris\InventarisController@edit')->name('inventarisEdit');

        //route profil
        Route::get('/profile', 'Profile\ProfileController@index')->name('profile');
        Route::post('/profile', 'Profile\ProfileController@uploadFoto')->name('uploadFotoProfile');

        //route pengaturan_akun
        Route::get('/pengaturan_akun', 'Pengaturan_Akun\PengaturanAkunController@index')->name('pengaturanAkun');
        Route::post('/pengaturan_akun/update', 'Pengaturan_Akun\PengaturanAkunController@update')->name('pengaturanAkunUpdate');
    });
});
