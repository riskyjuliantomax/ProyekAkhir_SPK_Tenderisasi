<?php

use App\Http\Controllers\CripsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPengadaanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoTenderController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PendaftaranPesertaController;
use App\Http\Controllers\PengadaanBerjalanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\RiwayatPendaftaranController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index']);

Auth::routes();
//Login
Route::get('login', [SessionController::class, 'index'])->name('login');
Route::post('sesi/login', [SessionController::class, 'login'])->name('sesi.login');
Route::get('sesi/logout', [SessionController::class, 'logout']);
Route::get('Dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');
Route::get('/home', [HomeController::class, 'index'])->name('home.user');
//List Pengadaan
Route::get('ListPengadaan', [PendaftaranPesertaController::class, 'listPengadaan']);
//Detail
Route::get('DetailPengadaan/{id_infoPengadaan}', [DetailPengadaanController::class, 'index']);
Route::get('DetailPengadaan/LihatHasil/{id_infoPengadaan}', [DetailPengadaanController::class, 'lihatHasil']);

Route::middleware(['auth', 'user_role:user'])->group(function () {
    //Pendaftaran Peserta
    Route::get('PendaftaranPeserta/{id_infoPengadaan}', [PendaftaranPesertaController::class, 'show']);
    Route::post('PendaftaranPeserta/{id_infoPengadaan}', [PendaftaranPesertaController::class, 'store']);
    Route::get('RiwayatPendaftaran', [RiwayatPendaftaranController::class, 'index']);
    Route::get('RiwayatPendaftaran/{id_infoPengadaan}', [RiwayatPendaftaranController::class, 'show']);
    Route::get('RiwayatPendaftaran/Edit/{id_infoPengadaan}', [RiwayatPendaftaranController::class, 'showUpdate']);
    Route::post('RiwayatPendaftaran/Update/{id_infoPengadaan}', [PendaftaranPesertaController::class, 'update']);
});
Route::middleware(['auth', 'user_role:pokja'])->group(function () {
    //Info
    Route::get('InfoTender', [InfoTenderController::class, 'index'])->name('InfoTender.index');
    Route::get('InfoTender/create', [InfoTenderController::class, 'create'])->name('InfoTender.create');
    Route::post('InfoTender/store', [InfoTenderController::class, 'store'])->name('InfoTender.store');
    Route::get('InfoTender/show/{id_infoTender}', [InfoTenderController::class, 'show'])->name('infoTender.show');
    Route::put('InfoTender/update/{id_infoTender}', [InfoTenderController::class, 'update'])->name('InfoTender.update');
    Route::delete('InfoTender/delete/{id_infoTender}', [InfoTenderController::class, 'delete'])->name('InfoTender.delete');
    // PermintaanPeserta
    Route::get('PengadaanBerjalan', [PendaftaranPesertaController::class, 'pengadaanIndex'])->name('permintaanPeserta.index');
    Route::get('PengadaanBerjalan/Detail/{id_infoTender}', [PengadaanBerjalanController::class, 'index']);
    Route::get('PengadaanBerjalan/Detail/Peserta/{id_pendaftaran}', [PengadaanBerjalanController::class, 'indexPeserta']);
    Route::post('PengadaanBerjalan/UpdatePeserta/{id_infoTender}', [PengadaanBerjalanController::class, 'updateApprove'])->name('PermintaPeserta.updatePeserta');
    //Peserta
    Route::get('Perusahaan', [PerusahaanController::class, 'index'])->name('Perusahaan.index');
    Route::post('Perusahaan', [PerusahaanController::class, 'store'])->name('Perusahaan.store');
    Route::put('Perusahaan/{id_perusahaan}', [PerusahaanController::class, 'update'])->name('Perusahaan.update');
    Route::delete('Perusahaan/delete/{id_perusahaan}', [PerusahaanController::class, 'delete'])->name('Perusahaan.delete');
    //Kriteria
    Route::get('Kriteria', [KriteriaController::class, 'index'])->name('Kriteria.index');
    Route::post('Kriteria', [KriteriaController::class, 'store'])->name('Kriteria.store');
    Route::get('Kriteria/edit/{id_kriteria}', [KriteriaController::class, 'edit'])->name('Kriteria.edit');
    Route::put('Kriteria/update/{id_kriteria}', [KriteriaController::class, 'update'])->name('Kriteria.update');
    Route::get('Kriteria/lock', [KriteriaController::class, 'lock'])->name('kriteria.lock');
    Route::delete('Kriteria/delete/{id_kriteria}', [KriteriaController::class, 'delete']);
    //Crips
    Route::get('Kriteria/Crips/{id_kriteria}', [KriteriaController::class, 'show'])->name('Crips.show');
    Route::post('Kriteria/Crips', [CripsController::class, 'store'])->name('Crips.store');
    Route::delete('Kriteria/Crips/delete/{id_crips}', [CripsController::class, 'delete']);
    Route::get('Kriteria/Crips/edit/{id_crips}', [CripsController::class, 'edit']);
    Route::put('Kriteria/Crips/update/{id_crips}', [CripsController::class, 'update']);
    //Penilaian
    Route::get('Penilaian', [PenilaianController::class, 'indexListPengadaan'])->name('Penilaian.indexListPengadaan');
    Route::get('Penilaian/Detail/{id_infoTender}', [PenilaianController::class, 'index'])->name('Penilaian.index');
    Route::post('Penilaian/{id_infoTender}', [PenilaianController::class, 'store'])->name('Penilaian.store');
    //Perhitungan
    Route::get('Perhitungan', [PerhitunganController::class, 'index'])->name('Perhitungan.index');
    Route::get('Penilaian/LihatHasil/{id_infoTender}', [PenilaianController::class, 'lihatHasil'])->name('Perhitungan.hasil');
});

Route::middleware(['auth', 'user_role:admin'])->group(function () {
    //Users
    Route::get('User', [UserController::class, 'index'])->name('User.index');
    Route::post('User', [UserController::class, 'store'])->name('User.store');
    Route::delete('User/delete/{id_user}', [UserController::class, 'delete']);
    Route::put('User/{id_user}', [UserController::class, 'update'])->name('User.update');
});
Route::get('/405', [DashboardController::class, 'Error405'])->name('Dashboard.Error405');
//Proteksi profile menggunakan Middleware Auth
Route::group(['middleware' =>  'auth',], function () {
    Route::get('Profile', [UserController::class, 'profile'])->name('User.profile');
    Route::post('/Profile/Update', [UserController::class, 'profile_update'])->name('Profile.update');
    // View PDF
    Route::get('ViewPDF/{hashNamePDF}', [PageController::class, 'viewDokumenPerusahaan']);
    Route::get('Download/{filename}', [PageController::class, 'download']);
});
