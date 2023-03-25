<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index() {
        return view('Peserta.index', [
            'title' => 'Peserta Tenderisasi',
            'breadcrumbs' => 'peserta',
        ]);
    }

    public function store (Request $request) {

    }
}
