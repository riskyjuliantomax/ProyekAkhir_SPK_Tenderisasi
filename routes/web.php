<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PerusahaanController;
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

Route::get('/Dashboard', [DashboardController::class, 'index'])-> name('Dashboard.index');
//Peserta
Route::get('/Peserta', [PesertaController::class, 'index'])-> name('Peserta.index');
Route::post('/Peserta', [PesertaController::class, 'store']);

Route::get('/Perusahaan', [PerusahaanController::class, 'index']);
