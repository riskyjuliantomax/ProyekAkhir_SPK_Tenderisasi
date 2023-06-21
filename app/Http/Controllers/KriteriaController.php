<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Alert;
use Error;
use App\Http\Helper\KriteriaHelper;
use App\Models\Crips;
use App\Models\KriteriaCost;
use App\Models\RiwayatAktivitas;
use Exception;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    // Function untuk menampilkan data
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $kriteria =  Kriteria::where('nama_kriteria', 'like', "%" . $request->search . "%")->paginate(10);
            $title = 'Mencari Kriteria';
        } else {
            $kriteria = Kriteria::orderBy('id_kriteria', 'desc')->paginate(10);
            $title = 'Kriteria';
        }
        return view('kriteria/index', compact('kriteria', 'title'));
    }
    // Function untuk store ke tabel kriteria
    public function store(Request $request)
    {
        //Validasi Form
        request()->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
        ], [
            'nama_kriteria.required' => 'Form Nama Kriteria Harus Diisi',
            'bobot.required' => 'Form Bobot Harus Diisi',
        ]);
        try {
            //Checking if Exists DB
            if (KriteriaCost::where('nama', $request->nama_kriteria)->exists()) {
                $attribut = "cost";
            } else {
                $attribut = "benefit";
            }
            // // //Cara Penyimpanan Biasa
            $Kriteria = Kriteria::create([
                'nama_kriteria' => $request->nama_kriteria,
                'bobot' => $request->bobot / 100,
                'attribut' => $attribut,
            ]);
            if ($Kriteria) {
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => ' Menambahkan Kriteria ',
                    'deskripsi2' => ' Menambahkan Kriteria ' . $request->nama_kriteria,
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);

                Alert::success('Berhasil', 'Data Kriteria Berhasil Disimpan');
                return redirect()->route('Kriteria.index');
            } else {
                Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
                return redirect()->route('Kriteria.index');
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
        }
    }

    // Function Untuk Update
    public function update(Request $request)
    {
        //Melakukan Validasi
        request()->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required',
        ], [
            'nama_kriteria.required' => 'Form Nama Kriteria Harus Diisi',
            'bobot.required' => 'Form Bobot Harus Diisi',
        ]);
        try {
            // $oldKriteria = Kriteria::find($request->id_kriteria);
            $Kriteria = Kriteria::find($request->id_kriteria);
            $Kriteria->update([
                'nama_kriteria' => $request->nama_kriteria,
                'bobot' => $request->bobot / 100,
                'attribut' => $request->attribut,
            ]);
            if ($Kriteria) {
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => ' Update Kriteria ',
                    'deskripsi2' => ' Update Kriteria ' . $request->nama_kriteria,
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);

                Alert::success('Berhasil Update', 'Data Kriteria Berhasil Update');
                return redirect()->route('Kriteria.index');
            } else {
                Alert::error('Gagal Update', 'Data Tidak Berhasil Update');
                return redirect()->route('Kriteria.index')->with(['gagal' => 'Data Gagal Simpan']);
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
        }
    }
    public function edit($id_kriteria)
    {
        $kriteria = Kriteria::find($id_kriteria);
        // return response()->json($kriteria);
        return view('Kriteria.update', compact('kriteria'))->with([
            'title' => 'Edit Kriteria',
        ]);
    }
    // Show untuk Crips Per Kriteria
    public function show($id_kriteria)
    {
        $data['crips'] = Crips::where('id_kriteria', $id_kriteria)->get();
        $data['kriteria'] = Kriteria::findOrFail($id_kriteria);
        return view('Crips.index', compact('data'))->with([
            'title' => 'Crips',
        ]);
    }
    // Delete Kriteria By Id
    public function delete($id_kriteria)
    {
        $Kriteria = Kriteria::Find($id_kriteria);
        if ($Kriteria) {
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' =>  ' Hapus Kriteria ',
                'deskripsi2' =>  ' Hapus Kriteria ' . $Kriteria->nama_kriteria,
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);
        }
        $Kriteria->delete();
        return response()->json(['status' => 'Berhasil Hapus Kriteria']);
    }
}
