<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Kriteria;
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
        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        $alternatif = Perusahaan::with('penilaian.crips')->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->get();

        if (Auth::check()) {
            if (Auth()->user()->role == 'pokja' || Auth()->user()->role == 'admin') {
                $riwayat_aktivitas = RiwayatAktivitas::where('role', auth()->user()->role)->with('User')->orderBy('id_riwayat_aktivitas', 'desc')->limit(20)->get();
            }
            if (Auth()->user()->role == 'user') {
                $riwayat_aktivitas = RiwayatAktivitas::where('id_users', auth()->user()->id_users)->with('User')->orderBy('id_riwayat_aktivitas', 'desc')->limit(20)->get();
            }
        }

        if (count($penilaian) > 0) {
            foreach ($kriteria as $key => $value) {
                foreach ($penilaian as $key_1 => $value_1) {
                    if ($value->id_kriteria == $value_1->crips->id_kriteria) {
                        if ($value->attribut == 'benefit') {
                            $minMax[$value->id_kriteria][] = $value_1->crips->nilai;
                        } elseif ($value->attribut == 'cost') {
                            $minMax[$value->id_kriteria][] = $value_1->crips->nilai;
                        }
                    }
                }
            }
            //Normalisasi
            foreach ($penilaian as $key_1 => $value_1) {
                foreach ($kriteria as $key => $value) {
                    if ($value->id_kriteria == $value_1->crips->id_kriteria) {
                        if ($value->attribut == 'benefit') {
                            $normalisasi[$value_1->alternatif->nama_perusahaan][$value->id_kriteria] = $value_1->crips->nilai / max($minMax[$value->id_kriteria]);
                        } elseif ($value->attribut == 'cost') {
                            $normalisasi[$value_1->alternatif->nama_perusahaan][$value->id_kriteria] = min($minMax[$value->id_kriteria]) / $value_1->crips->nilai;
                        }
                    }
                }
            }
            //Perangkingan
            foreach ($normalisasi as $key => $value) {
                foreach ($kriteria as $key_1 => $value_1) {
                    $rank[$key][] = $value[$value_1->id_kriteria] * $value_1->bobot;
                }
            }
            foreach ($normalisasi as $key => $value) {
                $normalisasi[$key][] = array_sum($rank[$key]);
            }
            $ranking = $normalisasi;
            arsort($ranking);

            if (Auth::check()) {
                return view('Dashboard.index', compact('kriteria', 'alternatif', 'normalisasi', 'ranking', 'penilaian', 'riwayat_aktivitas'))->with([
                    'title' => 'Hasil Perhitungan Ranking'
                ]);
            } else {
                return view('Dashboard.index', compact('kriteria', 'alternatif', 'normalisasi', 'ranking', 'penilaian'))->with([
                    'title' => 'Hasil Perhitungan Ranking'
                ]);
            }
        } else {
            if (Auth::check()) {
                return view('Dashboard.index', compact('kriteria', 'penilaian', 'riwayat_aktivitas'))->with(['title' => 'Dashboard SPK Tenderisasi']);
            } else {
                return view('Dashboard.index', compact('kriteria', 'penilaian'))->with(['title' => 'Dashboard SPK Tenderisasi']);
            }
        }
    }

    public function Error405()
    {
        return view('errors.405');
    }
}
