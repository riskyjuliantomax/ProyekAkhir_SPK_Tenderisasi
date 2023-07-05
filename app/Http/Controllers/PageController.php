<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUser;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function viewDokumenPerusahaan($hashNamePDF)
    {
        return view('PermintaanPeserta.viewPdf', compact('hashNamePDF'));
    }
}
