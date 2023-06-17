<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Alert;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Query Database
        $perusahaan = Perusahaan::with('penilaian.crips')->get();
        $kriteria = Kriteria::with('Crips')->orderBy('nama_kriteria', 'asc')->get();
        // return response()->json($perusahaan);
        // Return View
        return view(
            'Penilaian.index',
            // Return Value
            compact('perusahaan', 'kriteria')
        )->with([
            'title' => 'Penilaian',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::select("TRUNCATE penilaian");
            foreach ($request->id_crips as $key => $value) {
                foreach ($value as $key_1 => $value_1) {
                    Penilaian::create([
                        //Id ALternatif
                        'id_perusahaan' => $key,
                        'id_crips' => $value_1
                    ]);
                }
            }
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' => ucFirst(auth()->user()->role) . 'Update Penilaian',
                'deskripsi2' => ucFirst(auth()->user()->role) . ' Telah Melakukan Update Penilaian',
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);

            Alert::success('Berhasil', 'Data Berhasil Disimpan');
            return redirect()->route('Penilaian.index');
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Gagal Menambahkan Data');
            return redirect()->route('Penilaian.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
}
