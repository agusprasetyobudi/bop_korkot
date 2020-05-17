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
Route::group(['prefix'=>'buku-kas','middleware' => ['auth']], function () {
    Route::get('/','BukuKasController@index')->name('bukuKasView');
    Route::get('create','BukuKasController@create')->name('bukuKasCreate');
    Route::post('create','BukuKasController@store')->name('bukuKasStore');
});
Route::group(['prefix'=>'buku-bank','middleware' => ['auth']], function () {
    Route::get('/','BukuBankController@index')->name('bukuBankView');
    Route::get('create','BukuBankController@create')->name('bukuBankCreate');
    Route::post('create','BukuBankController@store')->name('bukuBankStore');
});
Route::group(['prefix' => 'firm'], function () {
    Route::get('/', 'FirmController@index')->name('firmView');
    Route::get('/create', 'FirmController@create')->name('firmCreateView');
    Route::post('/create', 'FirmController@store')->name('firmCreatePost');
});
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
Route::group(['prefix' => 'report', 'middleware'=>['auth']], function () {
    
});
Route::group(['prefix' => 'master', 'middleware'=>['auth']], function () {
    
});
Route::group(['prefix' => 'pengguna', 'middleware'=>['auth']], function () {
    
});
Route::get('/logout', 'HomeController@logout')->name('logout');
// Route::get('/rekapitulasi/bukti-transfer', 'FirmController@index')->name('buktiTransferView');
