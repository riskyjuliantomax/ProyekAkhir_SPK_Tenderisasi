<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Alert;
use App\Models\InfoTender;
use App\Models\Notifikasi;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexListPengadaan(Request $request)
    {
        if ($request->filled('search')) {
            $pengadaan =  InfoTender::where('nama_infoTender', 'like', "%" . $request->search . "%")
                ->orderBy('status', 'asc')->paginate(10);
            $title = 'Mencari Penilaian';
        } else {
            $pengadaan = InfoTender::sortable()->with('pesertaAcc')
                ->orderBy('status', 'asc')->orderBy('id_infoTender', 'desc')
                ->paginate(10);
            $title = 'Penilaian';
        }


        // return response()->json($pengadaan);
        return view(
            'Penilaian.listPengadaan',
            // Return Value
            compact('pengadaan')
        )->with([
            'title' => $title,
        ]);
    }
    public function index($id_infoTender)
    {
        // Query Database
        $perusahaan = Perusahaan::with('penilaian.crips')->where('id_infoTender', $id_infoTender)->get();
        $id_infoTender = InfoTender::select('id_infoTender', 'status')->where('id_infoTender', $id_infoTender)->first();
        $kriteria = Kriteria::with('Crips')->orderBy('nama_kriteria', 'asc')->get();
        // return response()->json($perusahaan);
        // Return View
        return view(
            'Penilaian.index',
            // Return Value
            compact('perusahaan', 'kriteria', 'id_infoTender')
        )->with([
            'title' => 'Penilaian',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_infoTender)
    {
        $idUsers = Perusahaan::join('info_tenders', 'info_tenders.id_infoTender', '=', 'perusahaan_dokumen.id_infoTender')
            ->select('id_users', 'info_tenders.nama_infoTender', 'info_tenders.id_infoTender')
            ->where('perusahaan_dokumen.id_infoTender', $id_infoTender)
            ->get();
        // return response()->json($idUsers);
        foreach ($idUsers as $dataId) {
            Notifikasi::create([
                'id_users' => $dataId->id_users,
                'pesan_notifikasi' => 'Pengadaan Barang ' . $dataId->nama_infoTender . ' Telah Selesai',
                'id_infoTender' => $dataId->id_infoTender,
            ]);
        }
        try {
            // DB::select("TRUNCATE penilaian");
            foreach ($request->id_crips as $key => $value) {
                foreach ($value as $key_1 => $value_1) {
                    Penilaian::create([
                        //Id ALternatif
                        'id_perusahaan' => $key,
                        'id_crips' => $value_1,
                        'id_infoTender' => $id_infoTender
                    ]);
                }
            }
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' => 'Update Penilaian',
                'deskripsi2' => ' Telah Melakukan Update Penilaian',
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);
            $pengadaan = InfoTender::find($request->id_infoTender);
            $pengadaan->status = 2;
            $pengadaan->save();

            Alert::success('Berhasil', 'Data Berhasil Disimpan');
            return redirect()->route('Penilaian.indexListPengadaan');
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Gagal Menambahkan Data');
            return redirect()->route('Penilaian.indexListPengadaan');
        }
    }

    public function lihatHasil($id_infoTender)
    {
        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        $alternatif = Perusahaan::with('penilaian.crips')->where('id_infoTender', $id_infoTender)->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->where('id_infoTender', $id_infoTender)->get();
        // return response()->json($alternatif);

        if (count($penilaian) == 0) {
            return redirect('Penilaian/Detail/' . $id_infoTender);
        }
        // Menentukan nilai min/max
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
        // return response()->json($normalisasi);
        foreach ($normalisasi as $key => $value) {
            $normalisasi[$key][] = array_sum($rank[$key]);
        }
        $ranking = $normalisasi;
        arsort($ranking);
        // return response()->json($ranking);
        //Return view dengan passing data
        return view('Penilaian.hasil_perhitungan', compact('kriteria', 'alternatif', 'normalisasi', 'ranking'))->with([
            'title' => 'Perhitungan'
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
}
