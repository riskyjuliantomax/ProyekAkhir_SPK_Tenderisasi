<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengadaanBarangController extends Controller
{
    //View Index Function
    public function index(){
        return view('PengadaanBarang.index',
        ['title' => 'Pengadaan Barang'],
    );
    
    }
    public function store(Request $request){

    }
}
