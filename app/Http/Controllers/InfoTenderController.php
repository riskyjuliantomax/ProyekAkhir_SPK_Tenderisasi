<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\InfoTender;
use App\Models\RiwayatAktivitas;
use Exception;

class InfoTenderController extends Controller
{
    public function index()
    {
        $infoTender = InfoTender::orderBy('id_infoTender', 'DESC')->limit(1)->get();
        // return response()->json($infoTender);
        return view('Info.tender', compact('infoTender'))->with([
            'title' => 'Info Tender'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $TenderId = InfoTender::orderBy('id_infoTender', 'DESC')->limit(1)->get();
            if (count($TenderId) > 0) {
                $infoTender = InfoTender::find($request->id_infoTender);
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => ' Update Info Tender ',
                    'deskripsi2' => ' Update Info Tender ' . $request->nama,
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);
            }
            if (count($TenderId) <= 0) {
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => ' Tambah Info Tender ',
                    'deskripsi2' => ' Tambah Info Tender ' . $request->nama,
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);
                $infoTender = new InfoTender();
            }
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
}
