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

    public function listPengadaan(Request $request)
    {
        if ($request->filled('search')) {
            $infoTender = InfoTender::sortable()
                ->orderBy('status', 'asc')
                ->orderBy('id_infoTender', 'DESC')
                ->where('nama_infoTender', 'like', "%" . $request->search . "%")
                ->paginate(10);
        } else {
            $infoTender = InfoTender::sortable()
                ->orderBy('status', 'asc')
                ->orderBy('id_infoTender', 'DESC')
                ->paginate(10);
        }


        // return response()->json($infoTender);
        return view('ListPengadaan.index', compact('infoTender'))->with([
            'title' => 'Pengadaan Barang',
        ]);
    }
    public function show($id_infoPengadaan)
    {
        $checkDaftarDoubleInsert = PendaftaranUser::with('infoTender')->where('id_users',  Auth()->user()->id_users)
            ->join('info_tenders', 'info_tenders.id_infoTender', '=', 'pendaftaran_users.id_infoTender')
            ->where('info_tenders.status', '==', '0')
            ->exists();
        if ($checkDaftarDoubleInsert) {
            return redirect('DetailPengadaan/' . $id_infoPengadaan);
        }
        $infoTender = InfoTender::select('nama_infoTender', 'id_infoTender')->where('id_infoTender', $id_infoPengadaan)->first();

        return view('PendaftaranPeserta.formPendaftaran', compact('infoTender'))->with([
            'title' => 'Form Pendaftaran'
        ]);
    }

    public function store(Request $request, $id_infoPengadaan)
    {
        request()->validate([
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'tahun_berdiri' => 'required',
            'harga_penawaran' => 'required',
            'nama_kontak' => 'required',
        ], [
            'nama_perusahaan.required' => 'Form Nama Perusahaan Harus Diisi',
            'alamat_perusahaan.required' => 'Form Alamat Harus Diisi',
            'tahun_berdiri.required' => 'Form Tahun Berdiri Perusahaan Harus Diisi',
            'harga_penawaran.required' => 'Form Harga Penawaran Harus Diisi',
            'nama_kontak.required' => 'Form Nama Yang Bisa Dikontak Harus Diisi',
        ]);
        try {
            $dokumenTender = $request->file('dokumen_perusahaan');
            $checkDaftar = PendaftaranUser::where('nama_perusahaan', $request->nama_perusahaan)
                ->where('id_users', '!=', Auth()->user()->id_users)
                ->first();
            if ($checkDaftar) {
                return redirect('PendaftaranPeserta/' . $id_infoPengadaan)->with([
                    'title' => 'Form Pendaftaran'
                ])->withErrors([
                    'Nama Perusahaan Sudah Diambil oleh User Lain'
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
                $pendaftaran->id_infoTender = $id_infoPengadaan;
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
                    return Redirect('ListPengadaan');
                } else {
                    Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
                    return Redirect('ListPengadaan');
                }
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return Redirect('ListPengadaan');
        }
    }
    public function update(Request $request, $id_infoPengadaan)
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
                return Redirect('ListPengadaan');
            } else {
                Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
                return Redirect('ListPengadaan');
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return Redirect::back();
        }
    }

    public function pengadaanIndex(Request $request)
    {
        if ($request->filled('search')) {
            $infoPengadaan = InfoTender::sortable()->with('peserta')->where('status', 0)
                ->orderBy('id_infoTender', 'desc')
                ->where('nama_infoTender', 'like', "%" . $request->search . "%")
                ->paginate(10);
        } else {
            $infoPengadaan = InfoTender::sortable()->with('peserta')
                ->orderBy('status', 'asc')
                ->orderBy('id_infoTender', 'desc')->paginate(10);
        }
        // return response()->json($infoPengadaan);
        return view('PermintaanPeserta.index', compact('infoPengadaan'))->with([
            'title' => 'Permintaan Peserta Pengadaan Sedang Berjalan',
        ]);
    }
    public function pengadaanShow()
    {
        echo 'test';
    }
}
