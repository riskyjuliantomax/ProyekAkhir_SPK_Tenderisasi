<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Alert;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Query Database
        $kriteria = DB::select('select * from kriteria order by id_kriteria asc');
        $kriteria_limit3 = DB::select('select nama_kriteria from kriteria order by id_kriteria asc limit 3');
        $perusahaan_noexists = DB::select('select id_perusahaan, nama_perusahaan from perusahaan where not exists (select id_perusahaan from penilaian where perusahaan.id_perusahaan = penilaian.id_perusahaan)');

        $perusahaan = DB::select('select * from perusahaan where exists (select id_perusahaan from penilaian where perusahaan.id_perusahaan = penilaian.id_perusahaan)');
        $kriteria_penilaian = DB::select('select * from penilaian where exists (select id_perusahaan from perusahaan where perusahaan.id_perusahaan = penilaian.id_perusahaan)');
        // $kriteria_penilaians = DB::table();
        // Return View
        return view(
            'Penilaian.index',
            // Return Value
            compact('kriteria', 'perusahaan', 'kriteria_limit3', 'perusahaan_noexists')
        )->with([
            'title' => 'Penilaian',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $countKriteria = DB::select('select nama_kriteria from Kriteria');
        $request->validate([
            'id_perusahaan' => 'required|not_in:0',
        ], [
            'id_perusahaan.required' => 'Perusahaan Harus Diisi',
        ]);
        try {
            //Looping untuk ambil form inputan di modal
            for ($i = 0; $i < count($countKriteria); $i++) {
                //inisalisasi untuk form inputan
                $nilai = $request->input('nilai_' . $i);
                $id_kriteria = $request->input('id_kriteria_' . $i);
                $id_perusahaan = $request->id_perusahaan;
                //Insert ke DB
                $penilaian = Penilaian::create([
                    'id_kriteria' => $id_kriteria,
                    'id_perusahaan' => $id_perusahaan,
                    'nilai' => $nilai,
                ]);
            }
            if ($penilaian) {
                Alert::success('Berhasil', 'Data Penilaian Berhasil Disimpan');
                return redirect()->route('Penilaian.index');
            } else {
                Alert::error('Gagal', 'Data Penilaian Tidak Berhasil Disimpan');
                return redirect()->route('Penilaian.index');
            }
        } catch (Exception $e) {
            Log::error($e);
            Alert::error('Gagal', 'Data Penilaian Tidak Berhasil Disimpan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $countKriteria = DB::select('select nama_kriteria from Kriteria');
            $penilaian = Penilaian::where('id_perusahaan', $request->id_perusahaan);
            for ($i = 0; $i < count($countKriteria); $i++) {
                $nilai = $request->input('nilai_' . $i);
                $id_perusahaan = $request->id_perusahaan;
                $penilaian = DB::update(
                    'update into penilaian(nilai) values (?) where id_perusahaan = ?' .
                        [$nilai, $id_perusahaan]
                );
            }
            if ($penilaian) {
                Alert::success('Berhasil', 'Data Penilaian Berhasil Disimpan');
                return redirect()->route('Penilaian.index');
            } else {
                Alert::error('Gagal', 'Data Penilaian Tidak Berhasil Disimpan');
                return redirect()->route('Penilaian.index');
            }
        } catch (Exception $e) {
            Log::error($e);
            Alert::error('Gagal', 'Data Penilaian Tidak Berhasil Disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id_penilaian)
    {
        //
    }
}
