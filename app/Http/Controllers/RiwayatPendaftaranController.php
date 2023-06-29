<?php

namespace App\Http\Controllers;

use App\Models\InfoTender;
use App\Models\PendaftaranUser;
use App\Models\Perusahaan;
use App\Models\RiwayatAktivitas;
use Illuminate\Http\Request;
use Alert;
use App\Models\Kriteria;
use App\Models\Notifikasi;
use App\Models\Penilaian;

class RiwayatPendaftaranController extends Controller
{
    //
    public function index()
    {
        $pendaftaran =   InfoTender::sortable()->with('peserta')
            ->orderBy('info_tenders.status', 'asc')
            ->join('pendaftaran_users', 'pendaftaran_users.id_infoTender', '=', 'info_tenders.id_infoTender')
            ->where('pendaftaran_users.id_users',  Auth()->user()->id_users)
            ->paginate(10);
        // return response()->json($pendaftaran);
        return view('RiwayatPendaftaran.index', compact('pendaftaran'))->with([
            'title' => 'Riwayat Pendaftaran',
        ]);
    }
    public function show($id_infoPengadaan)
    {
        $notifikasi = Notifikasi::where('id_users', Auth()->user()->id_users)
            ->where('id_infoTender', $id_infoPengadaan)->first();
        $notifikasi->update([
            'baca' => 1,
        ]);
        $pengadaan = Perusahaan::with('infoTender')->orderBy('id_pendaftaran_users', 'desc')
            ->where('id_users', auth()->user()->id_users)
            ->where('id_infoTender', $id_infoPengadaan)
            ->first();

        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        $alternatif = Perusahaan::with('penilaian.crips')->where('id_infoTender', $id_infoPengadaan)->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->where('id_infoTender', $id_infoPengadaan)->get();
        // return response()->json($pengadaan);

        // if (count($penilaian) == 0) {
        //     return redirect('RiwayatPendaftaran');
        // }

        foreach ($kriteria as $key => $value) {
            foreach ($penilaian as $key_1 => $value_1) {
                if ($value->id_kriteria == $value_1->crips->id_kriteria) {
                    if ($value->attribut == 'benefit') {
                        $minMax[$value->id_kriteria][] = $value_1->crips->nilai;
                    } elseif ($value->attribut == 'cost') {
                        $minMax[$value->id_kriteria][] = $value_1->crips->nilai;
                    }
                }
            }
        }
        // //Normalisasi
        foreach ($penilaian as $key_1 => $value_1) {
            foreach ($kriteria as $key => $value) {
                if ($value->id_kriteria == $value_1->crips->id_kriteria) {
                    if ($value->attribut == 'benefit') {
                        $normalisasi[$value_1->alternatif->nama_perusahaan][$value->id_kriteria] = $value_1->crips->nilai / max($minMax[$value->id_kriteria]);
                    } elseif ($value->attribut == 'cost') {
                        $normalisasi[$value_1->alternatif->nama_perusahaan][$value->id_kriteria] = min($minMax[$value->id_kriteria]) / $value_1->crips->nilai;
                    }
                }
            }
        }

        // //Perangkingan
        foreach ($normalisasi as $key => $value) {
            foreach ($kriteria as $key_1 => $value_1) {
                $rank[$key][] = $value[$value_1->id_kriteria] * $value_1->bobot;
            }
        }
        // return response()->json($normalisasi);
        foreach ($normalisasi as $key => $value) {
            $normalisasi[$key][] = array_sum($rank[$key]);
        }
        $ranking = $normalisasi;
        arsort($ranking);
        // return response()->json($pengadaan);
        return view('RiwayatPendaftaran.detail', compact('pengadaan', 'kriteria', 'alternatif', 'normalisasi', 'ranking'))->with([
            'title' => 'Detail Riwayat Pendaftaran',
        ]);
    }
    public function showUpdate($id_infoPengadaan)
    {
        $pendaftaran = PendaftaranUser::with('infoTender')->find($id_infoPengadaan);
        // return response()->json($pendaftaran);
        return view('RiwayatPendaftaran.edit', compact('pendaftaran'))->with([
            'title' => 'Edit Pendaftaran',
        ]);
    }

    public function update(Request $request, $id_pendaftaranUser)
    {
        try {
            $dokumenTender = $request->file('dokumen_perusahaan');
            // $dataPendaftaran = PendaftaranUser::with('user')->find($id_pendaftaranUser);

            $pendaftaran = PendaftaranUser::find($id_pendaftaranUser);
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' => 'Update Dokumen',
                'deskripsi2' => ' Telah Melakukan Update Dokumen Perusahaan',
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);

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
                return Redirect('RiwayatPendaftaran/Edit/' . $id_pendaftaranUser);
            } else {
                Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
                return Redirect('RiwayatPendaftaran/Edit/' . $id_pendaftaranUser);
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return Redirect::back();
        }
    }
}
