<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\InfoTender;
use App\Models\RiwayatAktivitas;
use Exception;

class InfoTenderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $infoTender = InfoTender::sortable()->where('nama_infotender', 'like', "%" . $request->search . "%")
                ->orderBy('id_infoTender', 'DESC')->paginate(10);
        } else {
            $infoTender = InfoTender::sortable()->orderBy('id_infoTender', 'desc')->paginate(10);
        }
        // return response()->json($infoTender);
        return view('InfoTender.index', compact('infoTender'))->with([
            'title' => 'Info Tender',
        ]);
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'harga' => 'required',
            'syarat' => 'required',
        ], [
            'nama.required' => 'Form Nama  Harus Diisi',
            'harga.required' => 'Form Harga Harus Diisi',
            'syarat.required' => 'Form Syarat Harus Diisi',
        ]);
        try {
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' => ' Tambah Info Tender ',
                'deskripsi2' => ' Tambah Info Tender ' . $request->nama,
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);
            $infoTender = new InfoTender();
            $infoTender->nama_infoTender = $request->nama;
            $infoTender->harga_infoTender = $request->harga;
            $infoTender->syarat_infoTender = $request->syarat;
            $infoTender->save();

            Alert::success('Berhasil', 'Data Berhasil Disimpan');
            return redirect()->route('InfoTender.index');
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return redirect()->route('InfoTender.index');
        }
    }
    public function create()
    {
        return view('InfoTender.create');
    }
    public function show($id_infoTender)
    {
        $data = InfoTender::find($id_infoTender);
        return view('InfoTender.update', compact('data'))->with([
            'title' => 'Info Tender'
        ]);
    }
    public function update(Request $request, $id_infoTender)
    {
        request()->validate([
            'nama' => 'required',
            'harga' => 'required',
            'syarat' => 'required',
        ], [
            'nama.required' => 'Form Nama  Harus Diisi',
            'harga.required' => 'Form Harga Harus Diisi',
            'syarat.required' => 'Form Syarat Harus Diisi',
        ]);
        try {

            $infoTender = InfoTender::find($id_infoTender);
            $infoTender->nama_infoTender = $request->nama;
            $infoTender->harga_infoTender = $request->harga;
            $infoTender->syarat_infoTender = $request->syarat;
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' => ' Update Info Tender ',
                'deskripsi2' => ' Update Info Tender ' . $request->nama,
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);
            $infoTender->save();

            Alert::success('Berhasil', 'Data Berhasil Disimpan');
            return redirect()->route('InfoTender.index');
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return redirect()->route('InfoTender.index');
        }
    }

    public function delete($id_infoTender)
    {
        $infoTender = InfoTender::find($id_infoTender);
        RiwayatAktivitas::create([
            'id_users' => auth()->user()->id_users,
            'deskripsi' => ' Hapus Info Tender ',
            'deskripsi2' => ' Hapus Info Tender Dengan Nama : ' . $infoTender->nama_infoTender,
            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
            'role' => auth()->user()->role,
        ]);
        $infoTender->delete();
    }
}
