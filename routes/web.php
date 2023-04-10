<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OrientasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UnivController;
use App\Http\Controllers\UploadevaluasidokterpendidikController;
use App\Http\Controllers\UploadevaluasikinerjadokterController;
use App\Http\Controllers\UploadevaluasipenyelenggaraanController;
use App\Http\Controllers\UploadkepuasanController;
use App\Http\Controllers\UploadkepuasanpasienController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::get('admin', function () {
    return 'Admin Page';
})->middleware('auth', 'admin');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::post('orientasis/downloadorientasipdf', [OrientasiController::class, 'downloadorientasipdf'])->name('downloadorientasipdf')->middleware('auth');
Route::post('mahasiswas/downloadmahasiswapdf', [MahasiswaController::class, 'downloadmahasiswapdf'])->name('downloadmahasiswapdf')->middleware('auth');
Route::get('mahasiswas/cetakmahasiswa', [MahasiswaController::class, 'cetakmahasiswa'])->name('cetakmahasiswa')->middleware('auth');
Route::get('orientasis/cetakorientasi', [OrientasiController::class, 'cetakorientasi'])->name('cetakorientasi')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('mahasiswas', MahasiswaController::class)->middleware('auth');
Route::resource('univs', UnivController::class)->middleware('auth');
Route::resource('ruangans', RuanganController::class)->middleware('auth');
Route::resource('uploadkepuasan', UploadkepuasanController::class)->middleware('auth');
Route::resource('uploadevaluasipenyelenggaraan', UploadevaluasipenyelenggaraanController::class)->middleware('auth');
Route::resource('uploadkepuasanpasien', UploadkepuasanpasienController::class)->middleware('auth');
Route::resource('uploadevaluasikinerjadokter', UploadevaluasikinerjadokterController::class)->middleware('auth');
Route::resource('uploadevaluasidokterpendidik', UploadevaluasidokterpendidikController::class)->middleware('auth');
Route::resource('orientasis', OrientasiController::class)->middleware('auth');

Auth::routes();
