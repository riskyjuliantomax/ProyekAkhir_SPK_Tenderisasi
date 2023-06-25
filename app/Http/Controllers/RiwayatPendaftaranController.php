<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranUser;
use Illuminate\Http\Request;

class RiwayatPendaftaranController extends Controller
{
    //
    public function index()
    {
        $pendaftaran = PendaftaranUser::with('infoTender')->orderBy('id_pendaftaran_users', 'desc')->where('id_users', auth()->user()->id_users)->paginate(10);

        // return response()->json($pendaftaran);
        return view('RiwayatPendaftaran.index', compact('pendaftaran'))->with([
            'title' => 'Riwayat Pendaftaran',
        ]);
    }
    public function show()
    {
        $pendaftaran = PendaftaranUser::with('infoTender')->orderBy('id_pendaftaran_users', 'desc')
            ->where('id_users', auth()->user()->id_users)
            ->where('id_pendaftaran_users', 2)
            ->paginate(10);
        // return response()->json($pendaftaran);
        return view('RiwayatPendaftaran.detail', compact('pendaftaran'))->with([
            'title' => 'Detail Riwayat Pendaftaran',
        ]);
    }
    public function update(Request $request, $id_pendaftaranUser)
    {
        return response()->json($request);
    }
}
