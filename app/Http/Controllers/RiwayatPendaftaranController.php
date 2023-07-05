<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use App\Models\PendaftaranUser;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use Illuminate\Http\Request;
use Alert;
use App\Models\Kriteria;
use App\Models\Notifikasi;
use App\Models\Penilaian;
use Exception;

class RiwayatPendaftaranController extends Controller
{
    //
    public function index()
    {
        $pendaftaran =   InfoTender::sortable()->with('peserta')
            ->orderBy('info_tenders.status', 'asc')
            ->join('pendaftaran_users', 'pendaftaran_users.id_infoTender', '=', 'info_tenders.id_infoTender')
            ->where('pendaftaran_users.id_users',  Auth()->user()->id_users)
            ->paginate(10);
        // return response()->json($pendaftaran);
        return view('RiwayatPendaftaran.index', compact('pendaftaran'))->with([
            'title' => 'Riwayat Pendaftaran',
        ]);
    }
    public function show($id_infoPengadaan)
    {
        $notifikasi = Notifikasi::where('id_users', Auth()->user()->id_users)
            ->where('id_infoTender', $id_infoPengadaan)->first();
        if ($notifikasi) {
            $notifikasi->update([
                'baca' => 1,
            ]);
        }
        $pengadaan = Perusahaan::with('infoTender')->orderBy('id_pendaftaran_users', 'desc')
            ->where('id_users', auth()->user()->id_users)
            ->where('id_infoTender', $id_infoPengadaan)
            ->first();

        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        $alternatif = Perusahaan::with('penilaian.crips')->where('id_infoTender', $id_infoPengadaan)->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->where('id_infoTender', $id_infoPengadaan)->get();
        // return response()->json($pengadaan);

        // if (count($penilaian) == 0) {
        //     return redirect('RiwayatPendaftaran');
        // }
        if ($alternatif) {
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
            return view('RiwayatPendaftaran.detail', compact('pengadaan', 'kriteria', 'alternatif', 'normalisasi', 'ranking'))->with([
                'title' => 'Detail Riwayat Pendaftaran',
            ]);
        } else {
            // return response()->json($pengadaan);
            return view('RiwayatPendaftaran.detail', compact('pengadaan'))->with([
                'title' => 'Detail Riwayat Pendaftaran',
            ]);
        }
    }
    public function showUpdate($id_infoPengadaan)
    {
        $pendaftaran = PendaftaranUser::with('infoTender')->find($id_infoPengadaan);
        // return response()->json($pendaftaran);
        return view('RiwayatPendaftaran.edit', compact('pendaftaran'))->with([
            'title' => 'Edit Pendaftaran',
        ]);
    }

    
}
