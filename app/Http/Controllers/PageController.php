<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUser;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function viewDokumenPerusahaan($id)
    {
        $data = PendaftaranUser::find($id);
        return view('PermintaanPeserta.viewPdf', compact('data'));
    }
}
