<?php

use App\Role;
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
Route::get('periode/month',function(){
    return \App\Facades\MonthnYear::getList()->month;
})->middleware('auth')->name('PeriodeMonthList');
Route::get('periode/year',function(){
    return \App\Facades\MonthnYear::getList()->year;
})->middleware('auth')->name('PeriodeYearList');
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
    Route::get('create', 'KontrakController@create')->name('KontrakCreateView');
    Route::post('create', 'KontrakController@store')->name('KontrakCreateStore');
    Route::get('destroy/{id}', 'KontrakController@destroy')->name('KontrakDestroy');
    Route::get('/{id}','KontrakController@show')->name('KontrakViewDetail');
    Route::get('/{id}/tambah','KontrakController@detail')->name('KontrakDetailCreate');
    Route::post('/{id}/tambah','KontrakController@post_detail')->name('KontrakDetailCreatePost');
    Route::get('destroy/detail/{id}', 'KontrakController@destroy_detail')->name('KontrakDestroyDetail');

});

#Firm Route
Route::group(['prefix' => 'firm','middleware' => ['auth']], function () {
    Route::get('/', 'FirmController@index')->name('firmView');
    Route::get('/create', 'FirmController@create')->name('firmCreateView');
    Route::post('/create', 'FirmController@store')->name('firmCreatePost');
    Route::get('edit/{id}', 'FirmController@edit')->name('firmEditView');
    Route::post('edit', 'FirmController@update')->name('firmEditPost');
    Route::get('delete/{id}', 'FirmController@destroy')->name('firmDestroy');
    Route::get('get', 'FirmController@api')->name('firmAPI');
});

#Rekapitulasi Route
Route::group(['prefix' => 'rekapitulasi', 'middleware'=>['auth']], function () {
    Route::group(['prefix' => 'bukti-transfer'], function () {
        Route::get('/', 'Rekapitulasi\TransferController@index')->name('buktiTransferView');
        Route::get('create', 'Rekapitulasi\TransferController@create')->name('buktiTransferCreate');
        Route::post('create', 'Rekapitulasi\TransferController@store')->name('buktiTransferPost');
        Route::get('edit/{id}', 'Rekapitulasi\TransferController@edit')->name('buktiTransferEdit');
        Route::post('edit', 'Rekapitulasi\TransferController@update')->name('buktiTransferUpdate');
        Route::get('destroy/{id}', 'Rekapitulasi\TransferController@destroy')->name('buktiTransferDestroy');
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
        Route::get('get','Master\ProvinsiController@get')->name('GetProvinsiAPI');
        Route::get('/','Master\ProvinsiController@index')->name('provinsiView');
        Route::get('create','Master\ProvinsiController@create')->name('provinsiCreate');
        Route::post('create','Master\ProvinsiController@store')->name('provinsiPost');
        Route::get('edit/{id}', 'Master\ProvinsiController@edit')->name('provinsiEditView');
        Route::post('edit', 'Master\ProvinsiController@update')->name('provinsiEditpost');
        Route::get('delete/{id}', 'Master\ProvinsiController@destroy')->name('provinsiDestroy');
    });
    Route::group(['prefix' => 'kabupaten'], function () {
        Route::get('/','Master\KabupatenKotaController@index')->name('KabupatenKotaView');
        Route::get('create','Master\KabupatenKotaController@create')->name('KabupatenKotaCreate');
        Route::post('create','Master\KabupatenKotaController@store')->name('KabupatenKotaPost');
        Route::get('edit/{id}', 'Master\KabupatenKotaController@edit')->name('KabupatenKotaEditView');
        Route::post('edit', 'Master\KabupatenKotaController@update')->name('KabupatenKotaEditpost');
        Route::get('delete/{id}', 'Master\KabupatenKotaController@destroy')->name('KabupatenKotaDestroy');
        Route::post('get', 'Master\KabupatenKotaController@show')->name('GetKabupatenKota');
    });
    Route::group(['prefix' => 'osp'], function () {
        Route::get('get', 'Master\OSPController@get')->name('OSPGetAPI');
        Route::get('/','Master\OSPController@index')->name('OSPView');
        Route::get('create','Master\OSPController@create')->name('OSPCreate');
        Route::post('create','Master\OSPController@store')->name('OSPPost');
        Route::get('edit/{id}', 'Master\OSPController@edit')->name('OSPEditView');
        Route::post('edit', 'Master\OSPController@update')->name('OSPEditpost');
        Route::get('delete/{id}', 'Master\OSPController@destroy')->name('OSPDestroy');
    });
    Route::group(['prefix' => 'kantor'], function () {
        Route::post('get','Master\KantorController@get')->name('KantorGetAPI');
        Route::get('/','Master\KantorController@index')->name('KantorView');
        Route::get('create','Master\KantorController@create')->name('KantorCreate');
        Route::post('create','Master\KantorController@store')->name('KantorPost');
        Route::get('edit/{id}', 'Master\KantorController@edit')->name('KantorEditView');
        Route::post('edit', 'Master\KantorController@update')->name('KantorEditpost');
        Route::get('destroy/{id}', 'Master\KantorController@destroy')->name('KantorDestroy');
    });
    Route::group(['prefix' => 'jabatan'], function () {
        Route::get('/','Master\JabatanController@index')->name('JabatanView');
        Route::get('create','Master\JabatanController@create')->name('JabatanCreate');
        Route::post('create','Master\JabatanController@store')->name('JabatanPost');
        Route::get('edit/{id}', 'Master\JabatanController@edit')->name('JabatanEditView');
        Route::post('edit', 'Master\JabatanController@update')->name('JabatanEditpost'); 
        Route::get('destroy/{id}', 'Master\JabatanController@destroy')->name('JabatanDestroy');
        Route::post('list','Master\JabatanController@show')->name('JabatanGetAjax');
        Route::post('roles/api','Master\JabatanController@rolesApi')->name('RolesGetAjax');
    });
    Route::group(['prefix' => 'bank'], function () {
        Route::get('/','Master\BankController@index')->name('BankView');
        Route::get('create','Master\BankController@create')->name('BankCreate');
        Route::post('create','Master\BankController@store')->name('BankPost');
        Route::get('edit/{id}', 'Master\BankController@edit')->name('BankEditView');
        Route::post('edit', 'Master\BankController@update')->name('BankEditpost'); 
        Route::get('destroy/{id}', 'Master\BankController@destroy')->name('BankDestroy');
        Route::post('list','Master\BankController@show')->name('BankGetAjax');
    });
    Route::group(['prefix' => 'komponen'], function () {
        Route::get('/','Master\KomponenBiayaController@index')->name('KomponenBiayaView');
        Route::get('create','Master\KomponenBiayaController@create')->name('KomponenBiayaCreate');
        Route::post('create','Master\KomponenBiayaController@store')->name('KomponenBiayaPost');
        Route::get('edit/{id}', 'Master\KomponenBiayaController@edit')->name('KomponenBiayaEditView');
        Route::post('edit', 'Master\KomponenBiayaController@update')->name('KomponenBiayaEditpost'); 
        Route::get('destroy/{id}', 'Master\KomponenBiayaController@destroy')->name('KomponenBiayaDestroy');
        Route::get('readonly/{id}', 'Master\KomponenBiayaController@readonly')->name('KomponenBiayaReadonly');
        Route::get('unreadonly/{id}', 'Master\KomponenBiayaController@unreadonly')->name('KomponenBiayaUnReadonly');
        Route::get('get','Master\KomponenBiayaController@get')->name('GetKomponenAPI');
        Route::group(['prefix' => 'sub'], function () {
            Route::post('get','Master\SubKomponenController@get')->name('GetSubKomponenAPI');
            Route::get('{id}/', 'Master\SubKomponenController@index')->name('SubKomponenView');            
            Route::get('{id}/create', 'Master\SubKomponenController@create')->name('SubKomponenCreateView');            
            Route::post('/create', 'Master\SubKomponenController@store')->name('SubKomponenCreatePost');            
            Route::get('{id}/edit/{sub_id}', 'Master\SubKomponenController@edit')->name('SubKomponenUpdateView');            
            Route::post('/edit', 'Master\SubKomponenController@update')->name('SubKomponenUpdatePost');            
            Route::get('{id}/delete/{sub_id}', 'Master\SubKomponenController@destroy')->name('SubKomponenDelete');            
        });
    });
    Route::group(['prefix' => 'aktifitas'], function () {
        Route::get('/','Master\AktifitasController@index')->name('AktifitasView');
        Route::get('create','Master\AktifitasController@create')->name('AktifitasCreate');
        Route::post('create','Master\AktifitasController@store')->name('AktifitasPost');
        Route::get('edit/{id}', 'Master\AktifitasController@edit')->name('AktifitasEditView');
        Route::post('edit', 'Master\AktifitasController@update')->name('AktifitasEditpost');
        Route::get('destroy/{id}', 'Master\AktifitasController@destroy')->name('AktifitasDestroy');
        Route::group(['prefix' => 'sub-komponen'], function () {
            Route::post('get','Master\SubKomponenAktifitasController@get')->name('GetSubAktifitasAPI');
            Route::get('{id}/{sub_id}','Master\SubKomponenAktifitasController@index')->name('AktifitasSubKomponen');
            Route::get('add/{id}/{sub_id}','Master\SubKomponenAktifitasController@create')->name('AktifitasSubKomponenAdd');
            Route::post('add','Master\SubKomponenAktifitasController@store')->name('AktifitasSubKomponenStore');
            Route::get('edit/{id}/{sub_id}','Master\SubKomponenAktifitasController@edit')->name('AktifitasSubKomponenEdit');
            Route::post('edit','Master\SubKomponenAktifitasController@update')->name('AktifitasSubKomponenUpdate');
            Route::get('destroy/{id}/{sub_id}','Master\SubKomponenAktifitasController@destroy')->name('AktifitasSubKomponenDestroy');
        });
    });
    Route::group(['prefix' => 'amandemen'], function () {
        Route::get('get','Master\AmandemenController@get')->name('AmandemenGetAPI');
        route::get('/','Master\AmandemenController@index')->name('AmandemenView');
        route::get('create','Master\AmandemenController@create')->name('AmandemenCreateView');
        route::post('create','Master\AmandemenController@store')->name('AmandemenCreatePost');
        route::get('update/{id}','Master\AmandemenController@edit')->name('AmandemenUpdateView');
        route::post('update','Master\AmandemenController@update')->name('AmandemenUpdatePost');
        route::get('destroy/{id}','Master\AmandemenController@destroy')->name('AmandemenDestroy');
    });
});

#Pengguna Route
Route::group(['prefix' => 'pengguna', 'middleware'=>['auth','role:administrator']], function () {
    Route::group(['prefix' => 'pengguna'], function () {
        Route::get('/','PenggunaController@index')->name('PenggunaView');
        Route::get('create','PenggunaController@create')->name('PenggunaCreate');
        Route::post('create','PenggunaController@store')->name('PenggunaPost');
        Route::get('edit', 'PenggunaController@edit')->name('PenggunaEditView');
        Route::post('edit', 'PenggunaController@update')->name('PenggunaEditpost'); 
        Route::get('destroy/{id}', 'PenggunaController@destroy')->name('PenggunaDestroy');
    });
    Route::group(['prefix' => 'kelompok-pengguna'], function () {
        Route::get('/','KelompokPenggunaController@index')->name('KelompokPenggunaView');
        Route::get('create','KelompokPenggunaController@create')->name('KelompokPenggunaCreate');
        Route::post('create','KelompokPenggunaController@store')->name('KelompokPenggunaPost');
        Route::get('edit', 'KelompokPenggunaController@edit')->name('KelompokPenggunaEditView');
        Route::post('edit', 'KelompokPenggunaController@update')->name('KelompokPenggunaEditpost'); 
        Route::get('destroy', 'KelompokPenggunaController@destroy')->name('KelompokPenggunaDestroy');
    });
});
Route::get('/logout', 'HomeController@logout')->name('logout');
// Route::get('/rekapitulasi/bukti-transfer', 'FirmController@index')->name('buktiTransferView');