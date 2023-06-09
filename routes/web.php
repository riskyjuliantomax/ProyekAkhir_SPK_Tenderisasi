<?php

use App\Http\Controllers\CripsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
//DashBoard
Route::get('Dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');
//Perusahaan
Route::get('Perusahaan', [PerusahaanController::class, 'index'])->name('Perusahaan.index');
Route::post('Perusahaan', [PerusahaanController::class, 'store'])->name('Perusahaan.store');
Route::put('Perusahaan/{id_perusahaan}', [PerusahaanController::class, 'update'])->name('Perusahaan.update');
Route::delete('Perusahaan/delete/{id_perusahaan}', [PerusahaanController::class, 'delete'])->name('Perusahaan.delete');
//Kriteria
Route::get('Kriteria', [KriteriaController::class, 'index'])->name('Kriteria.index');
Route::post('Kriteria', [KriteriaController::class, 'store'])->name('Kriteria.store');
Route::get('Kriteria/edit/{id_kriteria}', [KriteriaController::class, 'edit'])->name('Kriteria.edit');
Route::put('Kriteria/update/{id_kriteria}', [KriteriaController::class, 'update'])->name('Kriteria.update');
Route::delete('Kriteria/delete/{id_kriteria}', [KriteriaController::class, 'delete']);
//Crips
Route::get('Kriteria/Crips/{id_kriteria}', [KriteriaController::class, 'show'])->name('Crips.show');
Route::post('Kriteria/Crips', [CripsController::class, 'store'])->name('Crips.store');
Route::delete('Kriteria/Crips/delete/{id_crips}', [CripsController::class, 'delete']);
Route::get('Kriteria/Crips/edit/{id_crips}', [CripsController::class, 'edit']);
Route::put('Kriteria/Crips/update/{id_crips}', [CripsController::class, 'update']);
//Users
Route::get('User', [UserController::class, 'index'])->name('User.index');
Route::post('User', [UserController::class, 'store'])->name('User.store');
Route::delete('User/delete/{id_user}', [UserController::class, 'delete']);
Route::put('User/{id_user}', [UserController::class, 'update'])->name('User.update');
//Login
Route::get('login', [SessionController::class, 'index'])->name('Login');
//Penilaian
Route::get('Penilaian', [PenilaianController::class, 'index'])->name('Penilaian.index');
Route::post('Penilaian', [PenilaianController::class, 'store'])->name('Penilaian.store');
//Perhitungan
Route::get('Perhitungan', [PerhitunganController::class, 'index'])->name('Perhitungan.index');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
