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

        //JSON list
        Route::post('read_notif_json', 'NotifikasiController@read')->name('notifReadJSON');

        //route profil
        Route::get('/profile', 'Profile\ProfileController@index')->name('profile');
        Route::post('/profile', 'Profile\ProfileController@uploadFoto')->name('uploadFotoProfile');

        //route pengaturan_akun
        Route::get('/pengaturan_akun', 'Pengaturan_Akun\PengaturanAkunController@index')->name('pengaturanAkun');
        Route::post('/pengaturan_akun/update', 'Pengaturan_Akun\PengaturanAkunController@update')->name('pengaturanAkunUpdate');
    });
});
