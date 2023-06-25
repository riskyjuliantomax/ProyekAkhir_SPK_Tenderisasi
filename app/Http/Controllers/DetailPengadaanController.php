<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use Illuminate\Http\Request;

class DetailPengadaanController extends Controller
{
    //
    public function index($id_infoPengadaan)
    {
        $pengadaan = InfoTender::find($id_infoPengadaan);
        return view('DetailPengadaan.index', compact('pengadaan'));
    }
}
