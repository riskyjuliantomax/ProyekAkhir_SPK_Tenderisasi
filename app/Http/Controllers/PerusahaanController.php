<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Exception;
use Illuminate\Http\Request;
use Alert;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Log;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        //Pengecekan Search Terisi
        if ($request->filled('search')) {
            $perusahaan = Perusahaan::where('nama_perusahaan', 'like', "%" . $request->search . "%")->paginate(10);
        }
        //Kondisi Search Tidak Terisi
        else {
            $perusahaan = Perusahaan::orderBy('id_perusahaan', 'desc')->paginate(10);
        }
        return view('Perusahaan.index', compact('perusahaan'))->with([
            'title' => 'Peserta Tender',
        ]);
    }

    public function store(Request $request)
    {
        //Validasi Form
        request()->validate([
            'nama_perusahaan' => ['required'],
            'alamat_perusahaan' => ['required'],
        ], [
            'nama_perusahaan.required' => 'Form Nama Perusahaan Harus Dimasuki',
            'alamat_perusahaan.required' => 'Form Alamat Perusahaan Harus Dimasuki',
        ]);
        //Melakukan Penyimpanan Data
        try {
            $perusahaan = Perusahaan::create([
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'telp_perusahaan' => $request->telp_perusahaan,
                'email_perusahaan' => $request->email_perusahaan,
            ]);
            // Penilaian::truncate();
            if ($perusahaan) {
                Alert::success('Berhasil', 'Data Perusahaan Berhasil Disimpan');
                return redirect()->route('Perusahaan.index');
            } else {
                Alert::error('Gagal', 'Data Perusahaan Tidak Berhasil Disimpan');
                return redirect()->route('Perusahaan.index');
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Perusahaan Tidak Berhasil Disimpan');
            // return redirect()->route('Perusahaan.index');
        }
    }

    public function update(Request $request)
    {
        //Validasi Form
        request()->validate([
            'nama_perusahaan' => ['required'],
            'alamat_perusahaan' => ['required']
        ], [
            'nama_perusahaan.required' => 'Form Nama Perusahaan Harus Dimasuki',
            'alamat_perusahaan.required' => 'Form Alamat Perusahaan Harus Dimasuki',
        ]);
        //Melakukan Update
        try {
            $perusahaan = Perusahaan::find($request->id_perusahaan);
            $perusahaan->update([
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'email_perusahaan' => $request->email_perusahaan,
                'telp_perusahaan' => $request->telp_perusahaan,
            ]);
            if ($perusahaan) {
                Alert::success('Berhasil', 'Data Perusahaan Berhasil Disimpan');
                return redirect()->route('Perusahaan.index');
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Gagal Update');
            return redirect()->route('Perusahaan.index');
        }
    }

    public function delete($id_perusahaan)
    {
        $perusahaan = Perusahaan::Find($id_perusahaan);
        $perusahaan->delete();
        return response()->json(['status' => 'Berhasil Hapus Perusahaan']);
    }
}
