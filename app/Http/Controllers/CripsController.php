<?php

namespace App\Http\Controllers;

use App\Models\Crips;
use App\Models\Kriteria;
use Exception;
use Illuminate\Http\Request;
use Alert;
use App\Models\RiwayatAktivitas;
use Illuminate\Support\Facades\Redirect;

class CripsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama_crips' => 'required|string',
            'nilai' => 'required|numeric',
        ], [
            'nama_crips.string' => 'Form Nama Crips Harus Diisi Berupa Huruf',
            'nilai.numeric' => 'Form Harus Diisi Berupa Angka',
        ]);

        try {
            $crips = Crips::create([
                'id_kriteria' => $request->id_kriteria,
                'nama_crips' => $request->nama_crips,
                'nilai' => $request->nilai
            ]);

            $kriteria = Kriteria::find($request->id_kriteria);
            // return response()->json($kriteria);
            if ($crips) {
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => ucFirst(auth()->user()->role) . ' Menambahkan Crips ',
                    'deskripsi2' => ucFirst(auth()->user()->role) . ' Menambahkan Crips ' . $request->nama_crips . ' Dari Kriteria ' . $kriteria->nama_kriteria,
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);

                Alert::success('Berhasil Tambah', 'Data Crips Berhasil Update');
                return Redirect::back();
            } else {
                Alert::success('Berhasil Tambah', 'Data Crips Berhasil Update');
                return Redirect::back();
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Crips Tidak Berhasil Disimpan');
            return Redirect::back();
        }
    }
    public function edit($id_crips)
    {
        $crips = Crips::find($id_crips);
        return view('crips.update', compact('crips'))->with([
            'title' => 'Edit Crips'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_crips)
    {
        request()->validate([
            'nama_crips' => 'required|string',
            'nilai' => 'required|numeric',
        ], [
            'nama_crips.string' => 'Form Nama Crips Harus Diisi Berupa Huruf',
            'nilai.numeric' => 'Form Harus Diisi Berupa Angka',
        ]);

        try {
            $crips = Crips::find($id_crips);
            $crips->update([
                'nama_crips' => $request->nama_crips,
                'nilai' => $request->nilai
            ]);
            $kriteria = Kriteria::find($crips->id_kriteria);
            if ($crips) {
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => ucFirst(auth()->user()->role) . ' Update Crips ',
                    'deskripsi2' => ucFirst(auth()->user()->role) . ' Update Crips ' . $request->nama_crips . ' Dari Kriteria ' . $kriteria->nama_kriteria,
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);

                Alert::success('Berhasil Tambah', 'Data Crips Berhasil Update');
                return redirect('/Kriteria/Crips/' . $crips->id_kriteria);
            } else {
                Alert::error('Gagal Update', 'Data Tidak Berhasil Update');
                return redirect('/Kriteria/Crips/' . $crips->id_kriteria);
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id_crips)
    {
        $crips = Crips::Find($id_crips);
        $kriteria = Kriteria::find($crips->id_kriteria);
        RiwayatAktivitas::create([
            'id_users' => auth()->user()->id_users,
            'deskripsi' => ucFirst(auth()->user()->role) . ' Hapus Crips ',
            'deskripsi2' => ucFirst(auth()->user()->role) . ' Hapus Crips ' . $crips->nama_crips . ' Dari Kriteria ' . $kriteria->nama_kriteria,
            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
            'role' => auth()->user()->role,
        ]);

        // return response()->json($crips);
        $crips->delete();
        return response()->json(['status' => 'Berhasil Hapus Kriteria']);
    }
}
