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


Route::get('/', [KriteriaController::class, 'home'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::post('/user/tambah', [UserController::class, 'tambahUser']);
Route::get('/user/edit/{kode}', [userController::class, 'editUser']);
Route::post('/user/edit', [userController::class, 'updateUser']);
Route::delete('/user/{kode}', [userController::class, 'destroy']);

Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::post('/produk/tambah', [ProdukController::class, 'tambahProduk']);
Route::get('/produk/edit/{kode}', [ProdukController::class, 'editProduk']);
Route::post('/produk/edit', [ProdukController::class, 'updateProduk']);
Route::delete('/produk/{kode}', [ProdukController::class, 'destroy']);

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria');
Route::post('/kriteria/tambah', [KriteriaController::class, 'tambahKriteria']);
Route::get('/kriteria/edit/{kode}', [KriteriaController::class, 'editkriteria']);
Route::post('/kriteria/edit', [KriteriaController::class, 'updateKriteria']);
Route::delete('/kriteria/{kode}', [KriteriaController::class, 'destroy']);

Route::get('/alternatif', [AlternativeController::class, 'index'])->name('alternatif');
Route::post('/alternatif/tambah', [AlternativeController::class, 'tambahAlternatif']);
Route::get('/alternatif/edit/{kode}', [AlternativeController::class, 'editAlternatif']);
Route::post('/alternatif/edit', [ALternativeController::class, 'updateAlternatif']);
Route::delete('/alternatif/{kode}', [AlternativeController::class, 'destroy']);

Route::get('/surat/pengajuan', [SuratController::class, 'index'])->name('surat');
Route::get('/validasi', [SuratController::class, 'indexValidasi'])->name('suratValidasi');
Route::post('/pengajuan/tambah', [SuratController::class, 'submitRequest']);
Route::get('/pengajuan/edit/{kode}', [SuratController::class, 'editPengajuan']);
Route::post('/pengajuan/edit', [SuratController::class, 'updatePengajuan']);
Route::delete('/pengajuan/{kode}', [SuratController::class, 'destroy']);
Route::get('/partial/modal/decline/{kode}', [SuratController::class, 'modalDecline'])->name('modalDecline');
Route::post('/save/notes/{kode}', [SuratController::class, 'submitModalDecline'])->name('submitDecline');
Route::post('/validate/pengajuan/{kode}', [SuratController::class, 'validasiPengajuan'])->name('validateSPK');

// Route::get('/penilaian', [PenilaianController::class, 'index']);
Route::post('/penilaian/tambah', [PenilaianController::class, 'tambahPenilaian']);
Route::get('/penilaian/edit/{alternatif}', [PenilaianController::class, 'editPenilaian']);
Route::post('/penilaian/Edit', [PenilaianController::class, 'updatePenilaian']);

Route::get('/perhitungan', [PenilaianController::class, 'indexPerhitungan']);

Route::get('/hasil', [PenilaianController::class, 'hasil']);

Route::get('/print', [PenilaianController::class, 'indexPrint'])->name('print');
