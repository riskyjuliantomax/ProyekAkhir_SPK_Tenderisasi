<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use Illuminate\Http\Request;

class PendaftaranPesertaController extends Controller
{
    public function index()
    {
        $infoTender = InfoTender::orderBy('id_infoTender', 'DESC')->limit(1)->get();
        return view('PendaftaranPeserta.index', compact('infoTender'))->with([
            'title' => 'Daftar Sebagai Peserta',
        ]);
    }

    public function store(){
        
    }
}
