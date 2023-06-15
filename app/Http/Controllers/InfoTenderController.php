<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\InfoTender;
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
            }
            if (count($TenderId) <= 0) {
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
