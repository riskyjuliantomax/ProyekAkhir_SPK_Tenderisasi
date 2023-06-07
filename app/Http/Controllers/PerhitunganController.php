<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        return view('Perhitungan.index', compact('kriteria'))->with([
            'title' => 'Perhitungan'
        ]);
    }
}
