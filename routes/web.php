<?php

use App\Models\KriteriaModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratController;
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

Route::get('/login', [AuthController::class, 'tampilanLogin'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login/masuk', [AuthController::class, 'Login'])->name('proses_login');
Route::get('/daftar', [AuthController::class, 'tampilanDaftar']);
Route::post('/daftar', [AuthController::class, 'daftar']);
Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.update');


Route::get('/', [KriteriaController::class, 'home'])->name('home')->middleware('auth');
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('auth');
Route::post('/user/tambah', [UserController::class, 'tambahUser'])->middleware('auth');
Route::get('/user/edit/{kode}', [userController::class, 'editUser'])->middleware('auth');
Route::post('/user/edit', [userController::class, 'updateUser'])->middleware('auth');
Route::delete('/user/{kode}', [userController::class, 'destroy'])->middleware('auth');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware('auth');
Route::post('/produk/tambah', [ProdukController::class, 'tambahProduk'])->middleware('auth');
Route::get('/produk/edit/{kode}', [ProdukController::class, 'editProduk'])->middleware('auth');
Route::post('/produk/edit', [ProdukController::class, 'updateProduk'])->middleware('auth');
Route::delete('/produk/{kode}', [ProdukController::class, 'destroy'])->middleware('auth');

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria')->middleware('auth');
Route::post('/kriteria/tambah', [KriteriaController::class, 'tambahKriteria'])->middleware('auth');
Route::get('/kriteria/edit/{kode}', [KriteriaController::class, 'editkriteria'])->middleware('auth');
Route::post('/kriteria/edit', [KriteriaController::class, 'updateKriteria'])->middleware('auth');
Route::delete('/kriteria/{kode}', [KriteriaController::class, 'destroy'])->middleware('auth');

Route::get('/alternatif', [AlternativeController::class, 'index'])->name('alternatif')->middleware('auth');
Route::post('/alternatif/tambah', [AlternativeController::class, 'tambahAlternatif'])->middleware('auth');
Route::get('/alternatif/edit/{kode}', [AlternativeController::class, 'editAlternatif'])->middleware('auth');
Route::post('/alternatif/edit', [ALternativeController::class, 'updateAlternatif'])->middleware('auth');
Route::delete('/alternatif/{kode}', [AlternativeController::class, 'destroy'])->middleware('auth');

Route::get('/surat/pengajuan', [SuratController::class, 'index'])->name('surat')->middleware('auth');
Route::get('/validasi', [SuratController::class, 'indexValidasi'])->name('suratValidasi')->middleware('auth');
Route::post('/pengajuan/tambah', [SuratController::class, 'submitRequest'])->middleware('auth');
Route::get('/pengajuan/edit/{kode}', [SuratController::class, 'editPengajuan'])->middleware('auth');
Route::post('/pengajuan/edit', [SuratController::class, 'updatePengajuan'])->middleware('auth');
Route::delete('/pengajuan/{kode}', [SuratController::class, 'destroy'])->middleware('auth');
Route::get('/partial/modal/decline/{kode}', [SuratController::class, 'modalDecline'])->name('modalDecline')->middleware('auth');
Route::post('/save/notes/{kode}', [SuratController::class, 'submitModalDecline'])->name('submitDecline')->middleware('auth');
Route::post('/validate/pengajuan/{kode}', [SuratController::class, 'validasiPengajuan'])->name('validateSPK')->middleware('auth');

// Route::get('/penilaian', [PenilaianController::class, 'index'])->middleware('auth');
Route::post('/penilaian/tambah', [PenilaianController::class, 'tambahPenilaian'])->middleware('auth');
Route::get('/penilaian/edit/{alternatif}', [PenilaianController::class, 'editPenilaian'])->middleware('auth');
Route::post('/penilaian/Edit', [PenilaianController::class, 'updatePenilaian'])->middleware('auth');

Route::get('/perhitungan', [PenilaianController::class, 'indexPerhitungan'])->middleware('auth');

Route::get('/hasil', [PenilaianController::class, 'hasil'])->middleware('auth');

Route::get('/print', [PenilaianController::class, 'indexPrint'])->name('print')->middleware('auth');
