<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use App\Models\Kriteria;
use App\Models\PendaftaranUser;
use App\Models\Penilaian;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailPengadaanController extends Controller
{
    //
    public function index($id_infoPengadaan)
    {
        $pengadaan = InfoTender::find($id_infoPengadaan);
        if (Auth::check()) {
            $checkDaftarDoubleInsert = PendaftaranUser::with('infoTender')->where('id_users',  Auth()->user()->id_users)
                ->join('info_tenders', 'info_tenders.id_infoTender', '=', 'pendaftaran_users.id_infoTender')
                ->where('info_tenders.status', '==', '0')
                ->exists();
            return view('DetailPengadaan.index', compact('pengadaan', 'checkDaftarDoubleInsert'));
        } else {
            return view('DetailPengadaan.index', compact('pengadaan'));
        }
    }
    public function lihatHasil($id_infoPengadaan)
    {
        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        $alternatif = Perusahaan::with('penilaian.crips')->where('id_infoTender', $id_infoPengadaan)->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->where('id_infoTender', $id_infoPengadaan)->get();
        // return response()->json($alternatif);

        if (count($penilaian) == 0) {
            return redirect('DetailPengadaan/' . $id_infoPengadaan);
        }

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
        // //Normalisasi
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

        // //Perangkingan
        foreach ($normalisasi as $key => $value) {
            foreach ($kriteria as $key_1 => $value_1) {
                $rank[$key][] = $value[$value_1->id_kriteria] * $value_1->bobot;
            }
        }
        // return response()->json($normalisasi);
        foreach ($normalisasi as $key => $value) {
            $normalisasi[$key][] = array_sum($rank[$key]);
        }
        $ranking = $normalisasi;
        arsort($ranking);
        // return response()->json($ranking);
        // //Return view dengan passing data
        return view('DetailPengadaan.lihathasil', compact('kriteria', 'alternatif', 'normalisasi', 'ranking'))->with([
            'title' => 'Perhitungan'
        ]);
    }
}
