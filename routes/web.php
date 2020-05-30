<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    if(!empty(Auth::user())) 
    return redirect()->route('home');
    else
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/firm', 'FirmController@index')->name('firmView');

#Buku Kas Route
Route::group(['prefix'=>'buku-kas','middleware' => ['auth']], function () {
    Route::get('/','BukuKasController@index')->name('bukuKasView');
    Route::get('create','BukuKasController@create')->name('bukuKasCreate');
    Route::post('create','BukuKasController@store')->name('bukuKasStore');
});

#Buku Bank Route
Route::group(['prefix'=>'buku-bank','middleware' => ['auth']], function () {
    Route::get('/','BukuBankController@index')->name('bukuBankView');
    Route::get('create','BukuBankController@create')->name('bukuBankCreate');
    Route::post('create','BukuBankController@store')->name('bukuBankStore');
});

#Kontrak Route
Route::group(['prefix' => 'kontrak','middleware' => ['auth']], function () {
    Route::get('/', 'KontrakController@index')->name('KontrakHome');
    Route::get('create', 'KontrakController@create')->name('KontrakCreate');
    Route::post('create', 'KontrakController@store')->name('KontrakStore');
});

#Firm Route
Route::group(['prefix' => 'firm'], function () {
    Route::get('/', 'FirmController@index')->name('firmView');
    Route::get('/create', 'FirmController@create')->name('firmCreateView');
    Route::post('/create', 'FirmController@store')->name('firmCreatePost');
});

#Rekapitulasi Route
Route::group(['prefix' => 'rekapitulasi', 'middleware'=>['auth']], function () {
    Route::group(['prefix' => 'bukti-transfer'], function () {
        Route::get('/', 'RekapitulasiController@indexTransfer')->name('buktiTransferView');
        Route::get('create', 'RekapitulasiController@CreateTransfer')->name('buktiTransferCreate');
        Route::post('create', 'RekapitulasiController@StoreTransfer')->name('buktiTransferPost');
    });
    Route::group(['prefix' => 'bukti-pengeluaran'], function () {
        Route::get('/', 'RekapitulasiController@indexPengeluaran')->name('buktiPengeluaranView');
        Route::get('create', 'RekapitulasiController@CreatePengeluaran')->name('buktiPengeluaranCreate');
        Route::post('create', 'RekapitulasiController@StorePengeluaran')->name('buktiPengeluaranPost');
    });
});

#PMU Route
Route::group(['prefix' => 'pmu', 'middleware'=>['auth']], function () {
    //Rekapitulasi Input
     Route::get('rekap-input', 'PmuController@rekapInputView')->name('rekapInputView');
     Route::get('rekap-input/create', 'PmuController@rekapInputCreated')->name('rekapInputCreated');
     Route::post('rekap-input/create', 'PmuController@rekapInputStore')->name('rekapInputStore');
     //Invoice Terakhir
     Route::get('invoice-terakhir', 'PmuController@invoiceTerakhirView')->name('invoiceTerakhirView');
     Route::get('invoice-terakhir/create', 'PmuController@invoiceTerakhirCreated')->name('invoiceTerakhirCreated');
     Route::post('invoice-terakhir/create', 'PmuController@invoiceTerakhirStore')->name('invoiceTerakhirStore');
     //Rekapitulasi Kontrak
     Route::get('rekap-kontrak', 'PmuController@rekapKontrakView')->name('rekapKontrakView');
     Route::get('rekap-kontrak/create', 'PmuController@rekapKontrakCreated')->name('rekapKontrakCreated');
     Route::post('rekap-kontrak/create', 'PmuController@rekapKontrakStore')->name('rekapKontrakStore');
});

#Report Route
Route::group(['prefix' => 'report', 'middleware'=>['auth']], function () {
    Route::get('firm-transfer','FirmController@report')->name('firmTransferReporting'); 
    Route::get('penerima-transfer','ReportController@penerimaTF')->name('penerimaTransferReporting'); 
    Route::get('pengeluaran-transfer','ReportController@pengeluaranTF')->name('pengeluaranTransferReporting'); 
    Route::get('buku-bank','BukuBankController@report')->name('bukuBankReporting'); 
});

#Master Route
Route::group(['prefix' => 'master', 'middleware'=>['auth']], function () {
    Route::group(['prefix' => 'provinsi'], function () {
        Route::get('/','Master\ProvinsiController@index')->name('provinsiView');
        Route::get('create','Master\ProvinsiController@create')->name('provinsiCreate');
        Route::post('create','Master\ProvinsiController@store')->name('provinsiPost');
        Route::get('edit', 'Master\ProvinsiController@edit')->name('provinsiEditView');
        Route::post('edit', 'Master\ProvinsiController@update')->name('provinsiEditpost');
        Route::get('delete', 'Master\ProvinsiController@destory')->name('provinsiDeleteSoft');
        Route::get('destroy', 'Master\ProvinsiController@destory')->name('provinsiDestroy');
    });
    Route::group(['prefix' => 'kabupaten'], function () {
        Route::get('/','Master\KabupatenKotaController@index')->name('KabupatenKotaView');
        Route::get('create','Master\KabupatenKotaController@create')->name('KabupatenKotaCreate');
        Route::post('create','Master\KabupatenKotaController@store')->name('KabupatenKotaPost');
        Route::get('edit', 'Master\KabupatenKotaController@edit')->name('KabupatenKotaEditView');
        Route::post('edit', 'Master\KabupatenKotaController@update')->name('KabupatenKotaEditpost');
        Route::get('delete', 'Master\KabupatenKotaController@destory')->name('KabupatenKotaDeleteSoft');
        Route::get('destroy', 'Master\KabupatenKotaController@destory')->name('KabupatenKotaDestroy');
    });
    Route::group(['prefix' => 'osp'], function () {
        Route::get('/','Master\OSPController@index')->name('OSPView');
        Route::get('create','Master\OSPController@create')->name('OSPCreate');
        Route::post('create','Master\OSPController@store')->name('OSPPost');
        Route::get('edit', 'Master\OSPController@edit')->name('OSPEditView');
        Route::post('edit', 'Master\OSPController@update')->name('OSPEditpost');
        Route::get('delete', 'Master\OSPController@destory')->name('OSPDeleteSoft');
        Route::get('destroy', 'Master\OSPController@destory')->name('OSPDestroy');
    });
    Route::group(['prefix' => 'kantor'], function () {
        Route::get('/','Master\KantorController@index')->name('KantorView');
        Route::get('create','Master\KantorController@create')->name('KantorCreate');
        Route::post('create','Master\KantorController@store')->name('KantorPost');
        Route::get('edit', 'Master\KantorController@edit')->name('KantorEditView');
        Route::post('edit', 'Master\KantorController@update')->name('KantorEditpost');
        Route::get('delete', 'Master\KantorController@destory')->name('KantorDeleteSoft');
        Route::get('destroy', 'Master\KantorController@destory')->name('KantorDestroy');
    });
    Route::group(['prefix' => 'jabatan'], function () {
        Route::get('/','Master\JabatanController@index')->name('JabatanView');
        Route::get('create','Master\JabatanController@create')->name('JabatanCreate');
        Route::post('create','Master\JabatanController@store')->name('JabatanPost');
        Route::get('edit', 'Master\JabatanController@edit')->name('JabatanEditView');
        Route::post('edit', 'Master\JabatanController@update')->name('JabatanEditpost');
        Route::get('delete', 'Master\JabatanController@destory')->name('JabatanDeleteSoft');
        Route::get('destroy', 'Master\JabatanController@destory')->name('JabatanDestroy');
    });
    Route::group(['prefix' => 'komponen'], function () {
        Route::get('/','Master\KomponenBiayaController@index')->name('KomponenBiayaView');
        Route::get('create','Master\KomponenBiayaController@create')->name('KomponenBiayaCreate');
        Route::post('create','Master\KomponenBiayaController@store')->name('KomponenBiayaPost');
        Route::get('edit', 'Master\KomponenBiayaController@edit')->name('KomponenBiayaEditView');
        Route::post('edit', 'Master\KomponenBiayaController@update')->name('KomponenBiayaEditpost');
        Route::get('delete', 'Master\KomponenBiayaController@destory')->name('KomponenBiayaDeleteSoft');
        Route::get('destroy', 'Master\KomponenBiayaController@destory')->name('KomponenBiayaDestroy');
    });
    Route::group(['prefix' => 'aktifitas'], function () {
        Route::get('/','Master\AktifitasController@index')->name('AktifitasView');
        Route::get('create','Master\AktifitasController@create')->name('AktifitasCreate');
        Route::post('create','Master\AktifitasController@store')->name('AktifitasPost');
        Route::get('edit', 'Master\AktifitasController@edit')->name('AktifitasEditView');
        Route::post('edit', 'Master\AktifitasController@update')->name('AktifitasEditpost');
        Route::get('delete', 'Master\AktifitasController@destory')->name('AktifitasDeleteSoft');
        Route::get('destroy', 'Master\AktifitasController@destory')->name('AktifitasDestroy');
    });
});

#Pengguna Route
Route::group(['prefix' => 'pengguna', 'middleware'=>['auth']], function () {
    Route::group(['prefix' => 'pengguna'], function () {
        Route::get('/','PenggunaController@index')->name('PenggunaView');
        Route::get('create','PenggunaController@create')->name('PenggunaCreate');
        Route::post('create','PenggunaController@store')->name('PenggunaPost');
        Route::get('edit', 'PenggunaController@edit')->name('PenggunaEditView');
        Route::post('edit', 'PenggunaController@update')->name('PenggunaEditpost');
        Route::get('delete', 'PenggunaController@destory')->name('PenggunaDeleteSoft');
        Route::get('destroy', 'PenggunaController@destory')->name('AktifitasDestroy');
    });
    Route::group(['prefix' => 'kelompok-pengguna'], function () {
        Route::get('/','KelompokPenggunaController@index')->name('KelompokPenggunaView');
        Route::get('create','KelompokPenggunaController@create')->name('KelompokPenggunaCreate');
        Route::post('create','KelompokPenggunaController@store')->name('KelompokPenggunaPost');
        Route::get('edit', 'KelompokPenggunaController@edit')->name('KelompokPenggunaEditView');
        Route::post('edit', 'KelompokPenggunaController@update')->name('KelompokPenggunaEditpost');
        Route::get('delete', 'KelompokPenggunaController@destory')->name('KelompokPenggunaDeleteSoft');
        Route::get('destroy', 'KelompokPenggunaController@destory')->name('KelompokPenggunaDestroy');
    });
});
Route::get('/logout', 'HomeController@logout')->name('logout');
// Route::get('/rekapitulasi/bukti-transfer', 'FirmController@index')->name('buktiTransferView');