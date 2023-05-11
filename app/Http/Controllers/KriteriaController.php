<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Alert;
use Error;

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
            'bobot' => 'required',
            'attribut' => 'required',
        ], [
            'nama_kriteria.required' => 'Form Nama Kriteria Harus Diisi',
            'bobot.required' => 'Form Bobot Harus Diisi',
            'attribut.required' => 'Form Attribut Harus Diisi',
        ]);

        //Cara Penyimpanan Biasa
        $Kriteria = Kriteria::create([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot / 100,
            'attribut' => $request->attribut,
        ]);

        //Coba Menggunakan Eloquent ORM
        // $Kriteria = new Kriteria;
        // $Kriteria->nama_kriteria = $request->nama_kriteria;
        // $Kriteria->bobot = $request->bobot;
        // $Kriteria->attribut = $request->attribut;
        // $Kriteria->save();

        if ($Kriteria) {
            Alert::success('Berhasil', 'Data Kriteria Berhasil Disimpan');
            return redirect()->route('Kriteria.index');
        } else {
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return redirect()->route('Kriteria.index');
        }
    }

    // Function Untuk Update
    public function update(Request $request)
    {
        request()->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'attribut' => 'required',
        ], [
            'nama_kriteria.required' => 'Form Nama Kriteria Harus Diisi',
            'bobot.required' => 'Form Bobot Harus Diisi',
            'attribut.required' => 'Form Attribut Harus Diisi',
        ]);

        $Kriteria = Kriteria::find($request->id_kriteria);
        $Kriteria->nama_kriteria = $request->nama_kriteria;
        $Kriteria->bobot = $request->bobot / 100;
        $Kriteria->attribut = $request->attribut;
        $Kriteria->save();

        if ($Kriteria) {
            Alert::success('Berhasil Update', 'Data Kriteria Berhasil Update');
            return redirect()->route('Kriteria.index');
        } else {
            Alert::error('Gagal Update', 'Data Tidak Berhasil Update');
            return redirect()->route('Kriteria.index')->with(['gagal' => 'Data Gagal Simpan']);
        }
    }

    public function delete($id_kriteria)
    {
        $Kriteria = Kriteria::Find($id_kriteria);
        $Kriteria->delete();
        return response()->json(['status' => 'Berhasil Hapus Kriteria']);
    }
}
