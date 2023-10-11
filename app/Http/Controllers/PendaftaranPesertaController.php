<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use Exception;
use Illuminate\Http\Request;
use Alert;
use App\Models\PendaftaranUser;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use App\Models\UserPerusahaan;
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
            'harga_penawaran' => 'required',
            'dokumen_penawaran' => 'required',
            'dokumen_legalitas' => 'required',
            'dokumen_akta' => 'required',
        ], [
            'harga_penawaran.required' => 'Form Harga Penawaran Harus Diisi',
            'dokumen_penawaran.required' => 'Dokumen Penawaran Harus Di Upload',
            'dokumen_legalitas.required' => 'Dokumen Administrasi Harus Di Upload',
            'dokumen_akta.required' => 'Dokumen Akta Perusahaan Harus Di Upload'
        ]);
        try {
            $dokumen_penawaran = $request->file('dokumen_penawaran');
            $dokumen_legalitas = $request->file('dokumen_legalitas');
            $dokumen_akta = $request->file('dokumen_akta');
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
            // Get Data Perusahaan User
            $userPerusahaan = UserPerusahaan::where('id_users', Auth()->user()->id_users)->first();
            $pendaftaran->nama_perusahaan = $userPerusahaan->nama_perusahaan;
            $pendaftaran->npwp_perusahaan = $userPerusahaan->npwp_perusahaan;
            $pendaftaran->alamat_perusahaan = $userPerusahaan->alamat_perusahaan;
            $pendaftaran->telp_perusahaan = $userPerusahaan->telp_perusahaan;
            $pendaftaran->email_perusahaan = $userPerusahaan->email_perusahaan;
            // End Get Data Perusahaan User

            $pendaftaran->harga_penawaran = $request->harga_penawaran;

            // Check Kelengkapan Dokumentasi
            if ($dokumen_penawaran != '' && $dokumen_legalitas != '' && $dokumen_akta != '') {
                //upload Dokumen Penawaran
                $dokumen_penawaran->storeAs('public/dokumenPeserta/', $dokumen_penawaran->hashName());
                $pendaftaran->dokumen_penawaran = $dokumen_penawaran->hashName();
                //upload Dokumen Akta
                $dokumen_legalitas->storeAs('public/dokumenPeserta/', $dokumen_legalitas->hashName());
                $pendaftaran->dokumen_legalitas = $dokumen_legalitas->hashName();
                //upload Dokumen Legalitas
                $dokumen_akta->storeAs('public/dokumenPeserta/', $dokumen_akta->hashName());
                $pendaftaran->dokumen_akta = $dokumen_akta->hashName();
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
            return Redirect('ListPengadaan');
        }
    }
    public function update(Request $request, $id_pendaftaranUser)
    {
        try {
            $dokumen_penawaran = $request->file('dokumen_penawaran');
            $dokumen_legalitas = $request->file('dokumen_legalitas');
            $dokumen_akta = $request->file('dokumen_akta');
            $checkDaftar = PendaftaranUser::where('nama_perusahaan', $request->nama_perusahaan)
                ->where('id_users', '!=', Auth()->user()->id_users)
                ->first();
            if ($checkDaftar) {
                return redirect('RiwayatPendaftaran/Edit/' . $id_pendaftaranUser)->with([
                    'title' => 'Form Pendaftaran'
                ])->withErrors([
                    'Nama Perusahaan Sudah Diambil oleh User Lain'
                ]);
            } else {
                $pendaftaran = PendaftaranUser::find($id_pendaftaranUser);
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => 'Update Dokumen',
                    'deskripsi2' => ' Telah Melakukan Update Dokumen Perusahaan',
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);
                $pendaftaran->nama_perusahaan = $request->nama_perusahaan;
                $pendaftaran->npwp_perusahaan = $request->npwp_perusahaan;
                $pendaftaran->alamat_perusahaan = $request->alamat_perusahaan;
                $pendaftaran->harga_penawaran = $request->harga_penawaran;
                $pendaftaran->telp_perusahaan = $request->telp_perusahaan;
                $pendaftaran->email_perusahaan = $request->email_perusahaan;
                $time = \Carbon\Carbon::now()->toDateTimeString();
                if ($dokumen_penawaran != '') {
                    //upload Dokumen Penawaran
                    $dokumen_penawaran->storeAs('public/dokumenPeserta/', $dokumen_penawaran->hashName());
                    $pendaftaran->dokumen_penawaran = $dokumen_penawaran->hashName();
                }
                if ($dokumen_legalitas != '') {
                    //upload Dokumen Akta
                    $dokumen_legalitas->storeAs('public/dokumenPeserta/', $dokumen_legalitas->hashName());
                    $pendaftaran->dokumen_legalitas = $dokumen_legalitas->hashName();
                }
                if ($dokumen_akta != '') {
                    //upload Dokumen Legalitas
                    $dokumen_akta->storeAs('public/dokumenPeserta/', $dokumen_akta->hashName());
                    $pendaftaran->dokumen_akta = $dokumen_akta->hashName();
                }
                $pendaftaran->save();

                if ($pendaftaran) {
                    Alert::success('Berhasil', 'Data  Berhasil Disimpan');
                    return Redirect('RiwayatPendaftaran/Edit/' . $id_pendaftaranUser);
                } else {
                    Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
                    return Redirect('RiwayatPendaftaran/Edit/' . $id_pendaftaranUser);
                }
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
