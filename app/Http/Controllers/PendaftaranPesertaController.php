<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use Exception;
use Illuminate\Http\Request;
use Alert;
use App\Models\PendaftaranUser;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use Illuminate\Support\Facades\DB;
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
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => 'Update Dokumen',
                    'deskripsi2' => ' Telah Melakukan Update Dokumen Perusahaan',
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);
            } else {
                $pendaftaran = new PendaftaranUser();
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => 'Upload Dokumen',
                    'deskripsi2' => ' Telah Melakukan Tambah Dokumen',
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);
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

    public function userView(Request $request)
    {
        if ($request->filled('search')) {
            $pendaftaranUser = PendaftaranUser::with('user')->where('nama_perusahaan', 'like', "%" . $request->search . "%")
                ->orWhere('nama_kontak', 'like', "%" . $request->search . "%")
                ->orWhere('email_perusahaan', 'like', "%" . $request->search . "%")
                ->paginate(10);
        } else {
            $pendaftaranUser = PendaftaranUser::with('user')->orderBy('id_pendaftaran_users', 'DESC')->paginate(10);
            // return response()->json($approveUser);
        }
        return view('PermintaanPeserta.index', compact('pendaftaranUser'))->with([
            'title' => 'List Peserta',
        ]);
    }
    public function updateApprove(Request $request)
    {
        try {
            // $daftar = PendaftaranUser::find($request->id_pendaftaran_users);
            // $perusahaan = Perusahaan::where('id_users', $daftar->id_users)->get();
            // return response()->json($perusahaan);
            DB::transaction(function () use ($request) {
                $daftar = PendaftaranUser::find($request->id_pendaftaran_users);
                $daftar->approve = $request->approve;
                $daftar->save();

                $perusahaan = Perusahaan::where('id_users', $daftar->id_users)->first();
                if ($request->approve == 2) {
                    if ($perusahaan) {
                        $dataPerusahaan = Perusahaan::where('id_users', $request->id_users)->update([
                            'nama_perusahaan' => $daftar->nama_perusahaan,
                            'alamat_perusahaan' => $daftar->alamat_perusahaan,
                            'tahun_berdiri' => $daftar->tahun_berdiri,
                            'nama_kontak' => $daftar->nama_kontak,
                            'harga_penawaran' => $daftar->harga_penawaran,
                            'dokumen_perusahaan' => $daftar->dokumen_penawaran,
                            'telp_perusahaan' => $daftar->telp_perusahaan,
                            'email_perusahaan' => $daftar->email_perusahaan,
                        ]);
                        RiwayatAktivitas::create([
                            'id_users' => auth()->user()->id_users,
                            'deskripsi' => 'Update Peserta',
                            'deskripsi2' => ' Telah Melakukan Update Peserta',
                            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                            'role' => auth()->user()->role,
                        ]);
                    } else {
                        $dataPerusahaan = Perusahaan::create([
                            'id_users' => $daftar->id_users,
                            'nama_perusahaan' => $daftar->nama_perusahaan,
                            'alamat_perusahaan' => $daftar->alamat_perusahaan,
                            'tahun_berdiri' => $daftar->tahun_berdiri,
                            'nama_kontak' => $daftar->nama_kontak,
                            'harga_penawaran' => $daftar->harga_penawaran,
                            'dokumen_perusahaan' => $daftar->dokumen_penawaran,
                            'telp_perusahaan' => $daftar->telp_perusahaan,
                            'email_perusahaan' => $daftar->email_perusahaan,
                        ]);
                        RiwayatAktivitas::create([
                            'id_users' => auth()->user()->id_users,
                            'deskripsi' => 'Tambah Peserta',
                            'deskripsi2' => ' Telah Melakukan Tambah Peserta',
                            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                            'role' => auth()->user()->role,
                        ]);
                    }
                }
                if ($request->approve == 1 || $request->approve == 0) {
                    if ($perusahaan) {
                        $perusahaan->delete();
                        RiwayatAktivitas::create([
                            'id_users' => auth()->user()->id_users,
                            'deskripsi' => 'Update Peserta',
                            'deskripsi2' => ' Telah Melakukan Update Peserta',
                            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                            'role' => auth()->user()->role,
                        ]);
                    }
                }
            });
            Alert::success('Berhasil', 'Data Berhasil Di Update');
            return redirect()->route('permintaanPeserta.index');
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Gagal Di Update');
            return redirect()->route('permintaanPeserta.index');
        }
    }
}
