<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PengadaanBarangController;
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

Route::get('Dashboard', [DashboardController::class, 'index'])-> name('Dashboard.index');
//Peserta
Route::get('Peserta', [PesertaController::class, 'index'])-> name('Peserta.index');
Route::post('Peserta', [PesertaController::class, 'store']);
//Pengadaan Barang
Route::get('PengadaanBarang', [PengadaanBarangController::class, 'index'])-> name('PengadaanBarang.index');

Route::get('Perusahaan', [PerusahaanController::class, 'index']);
Route::get('Kriteria',[KriteriaController::class, 'index'])->name('Kriteria.index');
Route::post('Kriteria',[KriteriaController::class, 'store'])->name('Kriteria.store');
Route::put('Kriteria/{id_kriteria}',[KriteriaController::class, 'update'])->name('Kriteria.update');
Route::delete('Kriteria/delete/{id_kriteria}',[KriteriaController::class, 'delete']);
