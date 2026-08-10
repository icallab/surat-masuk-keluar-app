<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/home', function () {
	return redirect('/dashboard');
});


Auth::routes();

Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->middleware('auth')->name('dashboard');


Route::get('/surat-masuk', 'App\Http\Controllers\IncomingMailController@masuk')->name('surat_masuk')->middleware('auth');
Route::get('/tambah-surat-masuk', 'App\Http\Controllers\IncomingMailController@tambahView')->name('tambah_surat_masuk_view')->middleware('auth');
Route::post('/tambah-surat-masuk', 'App\Http\Controllers\IncomingMailController@tambah')->name('tambah_surat_masuk')->middleware('auth');
Route::get('/detail-surat-masuk{id}', 'App\Http\Controllers\IncomingMailController@detail')->name('detail_masuk')->middleware('auth');
Route::get('open_surat-masuk/{id}', 'App\Http\Controllers\IncomingMailController@open')->name('open_surat_masuk');
Route::get('/surat-masuk-hapus/{id}', 'App\Http\Controllers\IncomingMailController@hapus')->name('hapus_surat_masuk')->middleware('auth');
Route::put('/edit-masuk/{id}', 'App\Http\Controllers\IncomingMailController@edit')->name('edit_surat_masuk')->middleware('auth');


Route::get('/surat-keluar', 'App\Http\Controllers\OutgoingMailController@keluar')->name('surat_keluar')->middleware('auth');
// Route::get('/create', 'App\Http\Controllers\OutgoingMailController@create')->name('form_sk')->middleware('auth');
Route::get('/tambah-surat-keluar', 'App\Http\Controllers\OutgoingMailController@tambahView')->name('tambah_surat_keluar_view')->middleware('auth');
Route::post('/tambah-surat-keluar', 'App\Http\Controllers\OutgoingMailController@tambah')->name('tambah_surat_keluar')->middleware('auth');
Route::get('/konfirmasi-setuju/{id}', 'App\Http\Controllers\OutgoingMailController@konfirmasiSetuju')->name('konfirmasi_setuju')->middleware('auth');
// Route::post('/konfirmasi-setuju/{id}', 'App\Http\Controllers\OutgoingMailController@konfirmasiSetuju')->name('konfirmasi_setuju')->middleware('auth');
Route::get('/konfirmasi-tolak', 'App\Http\Controllers\OutgoingMailController@konfirmasiTolak')->name('konfirmasi_tolak')->middleware('auth');
Route::post('/konfirmasi-tolak', 'App\Http\Controllers\OutgoingMailController@konfirmasiTolak')->name('konfirmasi_tolak')->middleware('auth');
Route::get('/detail-surat-keluar{id}', 'App\Http\Controllers\OutgoingMailController@detail')->name('detail_keluar')->middleware('auth');
Route::get('/surat-keluar-hapus/{id}', 'App\Http\Controllers\OutgoingMailController@hapus')->name('hapus_surat_keluar')->middleware('auth');
Route::get('open_surat-keluar/{id}', 'App\Http\Controllers\OutgoingMailController@open')->name('open_surat_keluar');

Route::get('/tambah-surat-keluar-external', 'App\Http\Controllers\OutgoingMailController@tambahViewExternal')->name('tambah_surat_keluar_view_external')->middleware('auth');
Route::post('/tambah-surat-keluar-external', 'App\Http\Controllers\OutgoingMailController@tambah')->name('tambah_surat_keluar_external')->middleware('auth');

Route::put('/edit-keluar/{id}', 'App\Http\Controllers\OutgoingMailController@edit')->name('edit_surat_keluar')->middleware('auth');



Route::get('/disposisi', 'App\Http\Controllers\DispositionController@disposisi')->name('disposisi')->middleware('auth');
Route::post('/kirim', 'App\Http\Controllers\DispositionController@tambah')->name('tambah_disposisi')->middleware('auth');
Route::get('/detail-disposisi{id}', 'App\Http\Controllers\DispositionController@detail')->name('detail_disposisi')->middleware('auth');
Route::get('/disposisi-hapus{id}', 'App\Http\Controllers\DispositionController@hapus')->name('hapus_disposisi')->middleware('auth');

Route::put('/edit-disposisi{id}', 'App\Http\Controllers\DispositionController@edit')->name('edit_disposisi')->middleware('auth');

// tipe surat
// Route::prefix('tipe')->group(function() {
	Route::middleware(['auth', 'level:tatausaha'])->group(function () {
			// Uses first & second middleware...
			Route::get('/tipe-create', 'App\Http\Controllers\TypeController@create')->name('form_tipe');
			Route::put('/tipe-edit/{id}', 'App\Http\Controllers\TypeController@edit')->name('edit_tipe');
			Route::post('/store', 'App\Http\Controllers\TypeController@store')->name('tambah_tipe');
			Route::post('/cari', 'App\Http\Controllers\TypeController@cari')->name('tambah_cari');
			Route::get('/destroy/{id}', 'App\Http\Controllers\TypeController@destroy')->name('hapus_tipe');
		});
		
// });

//users
// Route::prefix('users')->group(function(){
	Route::middleware(['auth', 'level:tatausaha'])->group(function () {
	Route::get('/users-baca', 'App\Http\Controllers\UserController@baca')->name('form_user')->middleware('auth');
	Route::get('/hapus/{id}', 'App\Http\Controllers\UserController@hapus')->name('hapus_user')->middleware('auth');
	Route::put('/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('edit_user')->middleware('auth');
	Route::post('/tambah', 'App\Http\Controllers\UserController@tambah')->name('tambah_user')->middleware('auth');
	Route::post('/cari', 'App\Http\Controllers\UserController@cari')->name('cari_user')->middleware('auth');
	});
// });


Route::get('/laporan-masuk', 'App\Http\Controllers\IncomingMailController@laporanmasuk')->name('laporan-masuk')->middleware('auth');
Route::get('/laporan-masuk-pertanggal/{tglawal}/{tglakhir}', 'App\Http\Controllers\IncomingMailController@cetaklaporanmasuk')->name('laporan-masuk-pertanggal')->middleware('auth');

Route::get('/laporan-keluar', 'App\Http\Controllers\OutgoingMailController@laporankeluar')->name('laporan-keluar')->middleware('auth');
Route::get('/laporan-keluar-pertanggal/{tglawal}/{tglakhir}', 'App\Http\Controllers\OutgoingMailController@cetaklaporankeluar')->name('laporan-keluar-pertanggal')->middleware('auth');

Route::get('/laporan-disposisi', 'App\Http\Controllers\DispositionController@laporandisposisi')->name('laporan-disposisi')->middleware('auth');
Route::get('/laporan-disposisi-pertanggal/{tglawal}/{tglakhir}', 'App\Http\Controllers\DispositionController@cetaklaporandisposisi')->name('laporan-disposisi-pertanggal')->middleware('auth');