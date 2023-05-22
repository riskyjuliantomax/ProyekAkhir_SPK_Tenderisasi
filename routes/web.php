<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PengadaanBarangController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SubKriteria;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\UserController;
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

Route::get('Dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');
//Peserta
Route::get('Peserta', [PesertaController::class, 'index'])->name('Peserta.index');
Route::post('Peserta', [PesertaController::class, 'store']);
//Perusahaan
Route::get('Perusahaan', [PerusahaanController::class, 'index'])->name('Perusahaan.index');
Route::post('Perusahaan', [PerusahaanController::class, 'store'])->name('Perusahaan.store');
Route::put('Perusahaan/{id_perusahaan}', [PerusahaanController::class, 'update'])->name('Perusahaan.update');
Route::delete('Perusahaan/delete/{id_perusahaan}', [PerusahaanController::class, 'delete'])->name('Perusahaan.delete');
//Kriteria
Route::get('Kriteria', [KriteriaController::class, 'index'])->name('Kriteria.index');
Route::post('Kriteria', [KriteriaController::class, 'store'])->name('Kriteria.store');
Route::put('Kriteria/{id_kriteria}', [KriteriaController::class, 'update'])->name('Kriteria.update');
Route::delete('Kriteria/delete/{id_kriteria}', [KriteriaController::class, 'delete']);
//Users
Route::get('User', [UserController::class, 'index'])->name('User.index');
Route::post('User', [UserController::class, 'store'])->name('User.store');
Route::delete('User/delete/{id_user}', [UserController::class, 'delete']);
Route::put('User/{id_user}', [UserController::class, 'update'])->name('User.update');
//Penilaian
Route::get('Penilaian', [PenilaianController::class, 'index'])->name('Penilaian.index');
Route::post('Penilaian', [PenilaianController::class, 'store'])->name('Penilaian.store');
route::put('Penilaian/{id_perusahaan}', [PenilaianController::class, 'update'])->name('Penilaian.update');
Route::delete('Penilaian/{id_perusahaan}', [PenilaianController::class, 'delete']);
