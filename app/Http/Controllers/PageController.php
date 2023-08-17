<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;

class PageController extends Controller
{
    public function viewDokumenPerusahaan($hashNamePDF)
    {
        return view('PermintaanPeserta.viewPdf', compact('hashNamePDF'));
    }

    public function download($filename)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "\assets\document\Lampiranpenawaran.docx";

        $headers = array(
            'Content-Type: application/msword',
        );

        return FacadesResponse::download($file, 'templatePenawaran.docx', $headers);
    }
}
