<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OrientasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UnivController;
use App\Http\Controllers\FakulController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TingkatpendidikanController;
use App\Http\Controllers\UploadevaluasidokterpendidikController;
use App\Http\Controllers\UploadevaluasikinerjadokterController;
use App\Http\Controllers\UploadevaluasipenyelenggaraanController;
use App\Http\Controllers\UploadkepuasanController;
use App\Http\Controllers\UploadkepuasanpasienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IhtController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\TnaController;
use App\Http\Controllers\PegawaiController;
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

// Route::get('/',  function () {
//     return view('welcome');
// });
Route::get('/', [IhtController::class, 'indexDashboard'], function () {
    return view('home');
});

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [IhtController::class, 'indexDashboard'])->name('home')->middleware('auth');

// Route::get('/home', function () {
//     return view('home');
// })->name('home')->middleware('auth');

Route::post('orientasis/downloadorientasipdf', [OrientasiController::class, 'downloadorientasipdf'])->name('downloadorientasipdf')->middleware('auth');
Route::post('mahasiswas/downloadmahasiswapdf', [MahasiswaController::class, 'downloadmahasiswapdf'])->name('downloadmahasiswapdf')->middleware('auth');
Route::get('mahasiswas/cetakmahasiswa', [MahasiswaController::class, 'cetakmahasiswa'])->name('cetakmahasiswa')->middleware('auth');
Route::get('orientasis/cetakorientasi', [OrientasiController::class, 'cetakorientasi'])->name('cetakorientasi')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('mahasiswas', MahasiswaController::class)->middleware('auth');
Route::resource('univs', UnivController::class)->middleware('auth');
Route::resource('fakuls', FakulController::class)->middleware('auth');
Route::resource('jurusans', JurusanController::class)->middleware('auth');
Route::resource('prodis', ProdiController::class)->middleware('auth');
Route::resource('tingkatpendidikans', TingkatpendidikanController::class)->middleware('auth');
Route::resource('ruangans', RuanganController::class)->middleware('auth');
Route::resource('uploadkepuasan', UploadkepuasanController::class)->middleware('auth');
Route::resource('uploadevaluasipenyelenggaraan', UploadevaluasipenyelenggaraanController::class)->middleware('auth');
Route::resource('uploadkepuasanpasien', UploadkepuasanpasienController::class)->middleware('auth');
Route::resource('uploadevaluasikinerjadokter', UploadevaluasikinerjadokterController::class)->middleware('auth');
Route::resource('uploadevaluasidokterpendidik', UploadevaluasidokterpendidikController::class)->middleware('auth');
Route::resource('orientasis', OrientasiController::class)->middleware('auth');

//route all iht
Route::resource('/iht', IhtController::class)->middleware('auth');

//route to ihtDetail
Route::get('/iht/{iht}', [IhtController::class, 'show'])->name('iht.show')->middleware('auth');
//route input detail
Route::post('/addDetail', [IhtController::class, 'storeDetail'])->name('iht.storeDetail')->middleware('auth');
//route edit detail
Route::patch('/editDetail', [IhtController::class, 'updateDetail'])->name('iht.updateDetail')->middleware('auth');
//route delete detail
Route::delete('/deleteDetail/{detailIht}', [IhtController::class, 'destroyDetail'])->name('iht.destroyDetail')->middleware('auth');

//route to ihtDetailPeserta
Route::get('/iht/{id}/{detail_id}', [IhtController::class, 'showPeserta'])->name('iht.showPeserta')->middleware('auth');
//route input peserta
Route::post('/addPeserta', [IhtController::class, 'storePeserta'])->name('iht.storePeserta')->middleware('auth');
//route input narasumber
Route::post('/addNarasumber', [IhtController::class, 'storeNarasumber'])->name('iht.storeNarasumber')->middleware('auth');
//route edit peserta
Route::patch('/editPeserta', [IhtController::class, 'updatePeserta'])->name('iht.updatePeserta')->middleware('auth');
//route edit narasumber
Route::patch('/editNarasumber', [IhtController::class, 'updateNarasumber'])->name('iht.updateNarasumber')->middleware('auth');
// //route delete peserta
Route::delete('/deletePeserta/{pesertaIht}', [IhtController::class, 'destroyPeserta'])->name('iht.destroyPeserta')->middleware('auth');
// //route delete peserta
Route::delete('/deleteNarasumber/{narasumberIht}', [IhtController::class, 'destroyNarasumber'])->name('iht.destroyNarasumber')->middleware('auth');

//route kalender kegiatan
Route::resource('/kalender', KalenderController::class)->middleware('auth');

//route jpl
Route::resource('/jpls', JplController::class)->middleware('auth');
// Route::get('/jpls/{jpl}', 'JplController@show')->name('jpls.show')->middleware('auth');
Route::get('/jpls/test', [JplController::class, 'showDetail'])->name('jpls.showDetail')->middleware('auth');
Route::post('/get_fields', [JplController::class, 'getAllFields'])->name('get.all.fields')->middleware('auth');

//route tna utama
Route::get('/tnas/createTna', [TnaController::class, 'createUtama'])->name('tnas.createUtama')->middleware('auth');
Route::post('/tnas/storeTna', [TnaController::class, 'storeUtama'])->name('tnas.storeUtama')->middleware('auth');
Route::delete('/tnas/deleteTna/{tnaUtama}', [TnaController::class, 'destroyUtama'])->name('tnas.destroyUtama')->middleware('auth');
Route::get('/tnas/editTna/{tnaUtama}', [TnaController::class, 'editUtama'])->name('tnas.editUtama')->middleware('auth');
Route::patch('/tnas/updateTna/{tnaUtama}', [TnaController::class, 'updateUtama'])->name('tnas.updateUtama')->middleware('auth');
Route::get('/tnas/{tnaUtama}', [TnaController::class, 'show'])->name('tnas.show')->middleware('auth');
Route::get('/tnas/{tnaUtama}/create', [TnaController::class, 'create'])->name('tnas.createTna')->middleware('auth');
Route::post('/tnas/{tnaUtama}/store', [TnaController::class, 'store'])->name('tnas.store')->middleware('auth');
Route::delete('/tnas/{tnaUtama}/destroy/{tna}', [TnaController::class, 'destroy'])->name('tnas.destroy')->middleware('auth');
Route::get('/tnas/{tnaUtama}/edit/{tna}', [TnaController::class, 'edit'])->name('tnas.edit')->middleware('auth');
Route::patch('/tnas/update/{tna}', [TnaController::class, 'update'])->name('tnas.update')->middleware('auth');

Route::resource('tnas', TnaController::class)->middleware('auth');
//route input peserta
Route::post('/get_fields', [TnaController::class, 'getAllFields'])->name('get.all.fields')->middleware('auth');

//route pegawai
Route::resource('pegawais', PegawaiController::class)->middleware('auth');


//route cetak
Route::get('/filterPelatihan', [IhtController::class, 'filterPelatihan'])->name('filterPelatihan')->middleware('auth');
Route::get('/cetakPelatihan', [IhtController::class, 'cetakPelatihan'])->name('cetakPelatihan')->middleware('auth');
Route::get('/cetakDetail/{iht}', [IhtController::class, 'cetakDetail'])->name('cetakDetail')->middleware('auth');
Route::get('/cetakPeserta/{iht}/{detail_id}', [IhtController::class, 'cetakPeserta'])->name('cetakPeserta')->middleware('auth');
Route::get('/cetakTna/{tnaUtama}', [TnaController::class, 'cetakTna'])->name('cetakTna')->middleware('auth');
Route::get('/cetakPegawai', [PegawaiController::class, 'cetakPegawai'])->name('cetakPegawai')->middleware('auth');


Auth::routes();
