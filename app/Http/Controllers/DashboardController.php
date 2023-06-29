<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\InfoTender;
use App\Models\Kriteria;
use App\Models\Notifikasi;
use App\Models\PendaftaranUser;
use App\Models\Penilaian;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Dashboard Tenderisasi';
        $infoTender = InfoTender::orderBy('status', 'asc')->orderBy('id_infoTender', 'desc')->paginate(5);
        $countPengadaan = InfoTender::select('id_infoTender')->where('status', '0')->get();
        $countPengadaanSelesai = InfoTender::select('id_infoTender')->where('status', '!=', '0')->get();
        $countPeserta = PendaftaranUser::select('id_pendaftaran_users')->where('approve', '0')->get();
        $countPesertaSelesai = PendaftaranUser::select('id_pendaftaran_users')->where('approve', '!=', '0')->get();
        if (Auth::check()) {
            $notifikasi = Notifikasi::where('id_users', Auth()->user()->id_users)->get();
            if (Auth()->user()->role == 'pokja' || Auth()->user()->role == 'admin') {
                $riwayat_aktivitas = RiwayatAktivitas::where('role', auth()->user()->role)->with('User')->orderBy('id_riwayat_aktivitas', 'desc')->limit(20)->get();
            }
            if (Auth()->user()->role == 'user') {
                $riwayat_aktivitas = RiwayatAktivitas::where('id_users', auth()->user()->id_users)->with('User')->orderBy('id_riwayat_aktivitas', 'desc')->limit(20)->get();
            }
        }


        if (Auth::check()) {
            return view('Dashboard.index', compact('riwayat_aktivitas', 'infoTender', 'countPengadaan', 'countPengadaanSelesai', 'countPeserta', 'countPesertaSelesai', 'notifikasi'))->with(['title' => $title]);
        } else {
            return view('Dashboard.index', compact('infoTender', 'countPengadaan', 'countPengadaanSelesai', 'countPeserta', 'countPesertaSelesai'))->with(['title' => $title]);
        }
    }

    public function Error405()
    {
        return view('errors.405');
    }
}
