<?php

use App\Models\KriteriaModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [KriteriaController::class, 'home'])->name('home');

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

Route::get('/subKriteria', [KriteriaController::class, 'indexSub'])->name('subKriteria');
Route::post('/subKriteria/tambah/{i}', [KriteriaController::class, 'tambahSub'])->name('tambahSub');
Route::get('/subKriteria/edit/{id}', [KriteriaController::class, 'editsubKriteria']);
Route::post('/subKriteria/update', [KriteriaController::class, 'updateSubKriteria']);
Route::delete('/subKriteria/{id}', [KriteriaController::class, 'destroySub']);


Route::get('/penilaian', [PenilaianController::class, 'index']);
Route::post('/penilaian/tambah', [PenilaianController::class, 'tambahPenilaian']);
Route::get('/penilaian/edit/{alternatif}', [PenilaianController::class, 'editPenilaian']);
Route::post('/penilaian/Edit', [PenilaianController::class, 'updatePenilaian']);

Route::get('/perhitungan', [PenilaianController::class, 'indexPerhitungan']);

Route::get('/hasil', [PenilaianController::class, 'hasil']);

Route::get('/print', [PenilaianController::class, 'indexPrint'])->name('print');
