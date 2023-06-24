<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        $alternatif = Perusahaan::with('penilaian.crips')->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->get();
        // return response()->json($alternatif);

        if (count($penilaian) == 0) {
            return redirect(route('Penilaian.index'));
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
        // return response()->json($ranking);
        //Return view dengan passing data
        return view('Perhitungan.index', compact('kriteria', 'alternatif', 'normalisasi', 'ranking'))->with([
            'title' => 'Perhitungan'
        ]);
    }
}
