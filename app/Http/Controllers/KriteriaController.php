<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Alert;
use Error;

class KriteriaController extends Controller
{
    public function index(Request $request){


        if($request->filled('search')){
            $kriteria =  Kriteria::where('nama_kriteria', 'like', "%".$request->search."%")->paginate(10);
            $title = 'Mencari Kriteria';
        }else {
            $kriteria = Kriteria::orderBy('id_kriteria', 'desc')->paginate(10);
            $title = 'Kriteria';
        }

        return view('kriteria/index',compact('kriteria','title'));

    }

    public function store(Request $request){
        //Validasi Form
        $this->validate($request, [
            'nama_kriteria' => ['required', 'min:3'],
            'bobot' => 'required|integer|between:1,10',
            'attribut' => ['required', 'min:3']
        ]);

        //Cara Penyimpanan Biasa
        // $Kriteria = Kriteria::create([
        //     'nama_kriteria' => $request->nama_kriteria,
        //     'bobot' => $request->bobot,
        //     'attribut' => $request->attribut,
        // ]);

        //Coba Menggunakan Eloquent ORM
        $Kriteria = new Kriteria;
        $Kriteria->nama_kriteria = $request->nama_kriteria;
        $Kriteria->bobot = $request->bobot;
        $Kriteria->attribut = $request->attribut;
        $Kriteria->save();

        if($Kriteria){
            Alert::success('Berhasil', 'Data Kriteria Berhasil Disimpan');
            return redirect()->route('Kriteria.index');
        }else {
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return redirect()->route('Kriteria.index');
        }
    }

    public function update(Request $request){
        $this->validate($request, [
            'nama_kriteria' => ['required', 'min:3'],
            'bobot' =>'required|integer|between:1,10',
            'attribut' => ['required', 'min:3']
        ]);
        $Kriteria = Kriteria::find($request->id_kriteria);
        $Kriteria->nama_kriteria = $request->nama_kriteria;
        $Kriteria->bobot = $request->bobot;
        $Kriteria->attribut = $request->attribut;
        $Kriteria->save();

        if($Kriteria){
            Alert::success('Berhasil Update', 'Data Kriteria Berhasil Update');
            return redirect()->route('Kriteria.index');
        }else {
            Alert::error('Gagal Update', 'Data Tidak Berhasil Update');
            return redirect()->route('Kriteria.index')->with(['gagal'=> 'Data Gagal Simpan']);
        }
    }

    public function delete($id_kriteria){
        $Kriteria = Kriteria::Find($id_kriteria);
        $Kriteria -> delete();
        return response()->json(['status'=>'Berhasil Hapus Kriteria']);
    }

}
