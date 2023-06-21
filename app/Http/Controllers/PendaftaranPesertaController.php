<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use Exception;
use Illuminate\Http\Request;
use Alert;
use App\Models\PendaftaranUser;
use Illuminate\Support\Facades\Redirect;

class PendaftaranPesertaController extends Controller
{
    public function index()
    {
        $infoTender = InfoTender::orderBy('id_infoTender', 'DESC')->limit(1)->get();
        $pendaftaranUser = PendaftaranUser::where('id_users', Auth()->user()->id_users)->get();
        $approveUser = PendaftaranUser::select('approve')->where('id_users', Auth()->user()->id_users)->get();
        // return response()->json($approveUser);
        return view('PendaftaranPeserta.index', compact('infoTender', 'pendaftaranUser', 'approveUser'))->with([
            'title' => 'Daftar Sebagai Peserta',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $dokumenTender = $request->file('dokumen_perusahaan');
            $dataPendaftaran = PendaftaranUser::with('user')->where('id_users', Auth()->user()->id_users)->get();
            if (count($dataPendaftaran) > 0) {
                $pendaftaran = PendaftaranUser::find($request->id_pendaftaran_user);
            } else {
                $pendaftaran = new PendaftaranUser();
            }
            $pendaftaran->id_users = Auth()->user()->id_users;
            $pendaftaran->nama_perusahaan = $request->nama_perusahaan;
            $pendaftaran->alamat_perusahaan = $request->alamat_perusahaan;
            $pendaftaran->tahun_berdiri = $request->tahun_berdiri;
            $pendaftaran->nama_kontak = $request->nama_kontak;
            $pendaftaran->harga_penawaran = $request->harga_penawaran;

            $pendaftaran->telp_perusahaan = $request->telp_perusahaan;
            $pendaftaran->email_perusahaan = $request->email_perusahaan;
            if ($dokumenTender != null || $dokumenTender != '') {
                $dokumenTender->storeAs('public/dokumenTender/', $dokumenTender->hashName());
                $pendaftaran->dokumen_perusahaan = $dokumenTender->hashName();
            }
            $pendaftaran->save();

            if ($pendaftaran) {
                Alert::success('Berhasil', 'Data  Berhasil Disimpan');
                return Redirect::back();
            } else {
                Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
                return Redirect::back();
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return Redirect::back();
        }
    }

    public function userView()
    {

        $pendaftaranUser = PendaftaranUser::orderBy('id_pendaftaran_users', 'DESC')->paginate(10);
        // return response()->json($approveUser);
        return view('PermintaanPeserta.index', compact('pendaftaranUser'))->with([
            'title' => 'List Peserta',
        ]);
    }
}
