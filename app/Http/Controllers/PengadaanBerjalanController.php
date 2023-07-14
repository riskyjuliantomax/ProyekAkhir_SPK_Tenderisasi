<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use App\Models\PendaftaranUser;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Exception;

class PengadaanBerjalanController extends Controller
{
    //
    public function index($id_infoTender)
    {
        $infoTender = InfoTender::with('peserta')->where('id_infoTender', $id_infoTender)->first();
        $peserta = PendaftaranUser::sortable()
            ->where('pendaftaran_users.id_infoTender', $id_infoTender)->orderBy('id_pendaftaran_users', 'desc')
            ->join('info_tenders', 'info_tenders.id_infoTender', 'pendaftaran_users.id_infoTender',)
            ->select('pendaftaran_users.*', 'info_tenders.harga_infoTender', DB::raw('pendaftaran_users.harga_penawaran - info_tenders.harga_infoTender as selisihHarga'))
            ->get();
        // return response()->json($infoTender);
        return view('PengadaanBerjalan.DetailPengadaanBerjalan', compact('infoTender', 'peserta'))
            ->with([
                'title' => 'Detail Pengadaan Berjalan',
            ]);
    }
    public function indexPeserta($id_pendaftaran)
    {
        $pesertaPengadaan = PendaftaranUser::with('user', 'infoTender')->find($id_pendaftaran);
        // return response()->json($pesertaPengadaan);
        return view('PengadaanBerjalan.DetailPengadaanBerjalanPeserta', compact('pesertaPengadaan'));
    }

    public function updateApprove(Request $request, $id_infoTender)
    {
        try {
            // $daftar = PendaftaranUser::find($request->id_pendaftaran_users);
            // $perusahaan = Perusahaan::where('id_pendaftaran_users', $request->id_pendaftaran_users)->first();
            // return response()->json($daftar);

            DB::transaction(function () use ($request, $id_infoTender) {
                $daftar = PendaftaranUser::find($request->id_pendaftaran_users);
                $daftar->approve = $request->approve;
                $daftar->save();


                $perusahaan = Perusahaan::where('id_pendaftaran_users', $request->id_pendaftaran_users)->first();
                // echo $id_infoTender;
                // return response()->json($perusahaan);
                if ($request->approve == 2 && $perusahaan == null) {
                    echo $daftar->npwp_perusahaan;
                    Perusahaan::create([
                        'id_users' => $daftar->id_users,
                        'id_infoTender' => $id_infoTender,
                        'id_pendaftaran_users' => $daftar->id_pendaftaran_users,
                        'nama_perusahaan' => $daftar->nama_perusahaan,
                        'alamat_perusahaan' => $daftar->alamat_perusahaan,
                        'npwp_perusahaan' => $daftar->npwp_perusahaan,
                        'harga_penawaran' => $daftar->harga_penawaran,
                        'telp_perusahaan' => $daftar->telp_perusahaan,
                        'email_perusahaan' => $daftar->email_perusahaan,
                        'dokumen_legalitas' => $daftar->dokumen_legalitas,
                        'dokumen_penawaran' => $daftar->dokumen_penawaran,
                        'dokumen_akta' => $daftar->dokumen_akta,
                    ]);
                    RiwayatAktivitas::create([
                        'id_users' => auth()->user()->id_users,
                        'deskripsi' => 'Tambah Peserta',
                        'deskripsi2' => ' Telah Melakukan Tambah Peserta',
                        'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                        'role' => auth()->user()->role,
                    ]);
                } elseif ($request->approve != 2 && $perusahaan) {
                    $perusahaan->delete();
                    RiwayatAktivitas::create([
                        'id_users' => auth()->user()->id_users,
                        'deskripsi' => 'Update Peserta',
                        'deskripsi2' => ' Telah Melakukan Update Peserta',
                        'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                        'role' => auth()->user()->role,
                    ]);
                }
            });
            Alert::success('Berhasil', 'Data Berhasil Di Update');
            return redirect('PengadaanBerjalan/Detail/' . $id_infoTender);
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Gagal Di Update');
            return redirect('PengadaanBerjalan/Detail/' . $id_infoTender);
        }
    }
}
