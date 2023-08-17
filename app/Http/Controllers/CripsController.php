<?php

namespace App\Http\Controllers;

use App\Models\Crips;
use App\Models\Kriteria;
use Exception;
use Illuminate\Http\Request;
use Alert;
use App\Models\RiwayatAktivitas;
use Illuminate\Support\Facades\Redirect;

class CripsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama_crips' => 'required|string',
            'nilai' => 'required|numeric|min:1|max:5',
        ], [
            'nama_crips.string' => 'Form Nama Crips Harus Diisi Berupa Huruf',
            'nilai.numeric' => 'Form Harus Diisi Berupa Angka',
            'nilai.min' => 'Form Nilai Berisi Angka, Dan Minimal 1',
            'nilai.max' => 'Form nilai Berisi Angka, Dan Maksimal 5',
        ]);

        try {
            $validateCripsDoubleValue = Crips::where('id_kriteria', $request->id_kriteria)
                ->where('nilai', $request->nilai)
                ->exists();
            if ($validateCripsDoubleValue === true) {
                Alert::error('Gagal', 'Nilai Crips Tidak Boleh Sama');
                return Redirect::back();
            } else {
                $crips = Crips::create([
                    'id_kriteria' => $request->id_kriteria,
                    'nama_crips' => $request->nama_crips,
                    'nilai' => $request->nilai
                ]);
                $kriteria = Kriteria::find($request->id_kriteria);
                if ($crips) {
                    RiwayatAktivitas::create([
                        'id_users' => auth()->user()->id_users,
                        'deskripsi' => ' Menambahkan Crips ',
                        'deskripsi2' => ' Menambahkan Crips ' . $request->nama_crips . ' Dari Kriteria ' . $kriteria->nama_kriteria,
                        'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                        'role' => auth()->user()->role,
                    ]);

                    Alert::success('Berhasil Tambah', 'Data Crips Berhasil Update');
                    return Redirect::back();
                } else {
                    Alert::success('Berhasil Tambah', 'Data Crips Berhasil Update');
                    return Redirect::back();
                }
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Crips Tidak Berhasil Disimpan');
            return Redirect::back();
        }
    }
    public function edit($id_crips)
    {
        $crips = Crips::find($id_crips);
        return view('crips.update', compact('crips'))->with([
            'title' => 'Edit Crips'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_crips)
    {
        request()->validate([
            'nama_crips' => 'required|string',
            'nilai' => 'required|numeric|min:1|max:5',
        ], [
            'nama_crips.string' => 'Form Nama Crips Harus Diisi Berupa Huruf',
            'nilai.numeric' => 'Form Harus Diisi Berupa Angka',
            'nilai.min' => 'Form Nilai Berisi Angka, Dan Minimal 1',
            'nilai.max' => 'Form nilai Berisi Angka, Dan Maksimal 5',
        ]);

        try {
            $validateCripsDoubleValue = Crips::where('id_crips', $id_crips)
                ->where('nilai', $request->nilai)
                ->first();

            if ($validateCripsDoubleValue == true) {
                // Check nama value di Crips tidak sama dengan Crips
                $checknotsamename =  $validateCripsDoubleValue->nama_crips != $request->nama_crips;
                if ($checknotsamename == true) {
                    $crips = Crips::find($id_crips);
                    $crips->update([
                        'nama_crips' => $request->nama_crips,
                        'nilai' => $request->nilai
                    ]);
                    $kriteria = Kriteria::find($crips->id_kriteria);
                    if ($crips) {
                        RiwayatAktivitas::create([
                            'id_users' => auth()->user()->id_users,
                            'deskripsi' => ' Update Crips ',
                            'deskripsi2' => ' Update Crips ' . $request->nama_crips . ' Dari Kriteria ' . $kriteria->nama_kriteria,
                            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                            'role' => auth()->user()->role,
                        ]);

                        Alert::success('Berhasil Tambah', 'Data Crips Berhasil Update');
                        return redirect('/Kriteria/Crips/' . $crips->id_kriteria);
                    } else {
                        Alert::error('Gagal', 'Nilai Crips Tidak Boleh Sama');
                        return Redirect::back();
                    }
                } else {
                    $crips = Crips::find($id_crips);
                    $crips->update([
                        'nama_crips' => $request->nama_crips,
                        'nilai' => $request->nilai
                    ]);
                    $kriteria = Kriteria::find($crips->id_kriteria);
                    if ($crips) {
                        RiwayatAktivitas::create([
                            'id_users' => auth()->user()->id_users,
                            'deskripsi' => ' Update Crips ',
                            'deskripsi2' => ' Update Crips ' . $request->nama_crips . ' Dari Kriteria ' . $kriteria->nama_kriteria,
                            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                            'role' => auth()->user()->role,
                        ]);

                        Alert::success('Berhasil Tambah', 'Data Crips Berhasil Update');
                        return redirect('/Kriteria/Crips/' . $crips->id_kriteria);
                    } else {
                        Alert::error('Gagal Update', 'Data Tidak Berhasil Update');
                        return redirect('/Kriteria/Crips/' . $crips->id_kriteria);
                    }
                }
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id_crips)
    {
        try {
            $crips = Crips::Find($id_crips);
            $kriteria = Kriteria::find($crips->id_kriteria);
            $crips->delete();
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' => ' Hapus Crips ',
                'deskripsi2' => ' Hapus Crips ' . $crips->nama_crips . ' Dari Kriteria ' . $kriteria->nama_kriteria,
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);


            return response()->json(['status' => 'Berhasil Hapus Kriteria']);
        } catch (Exception $e) {
            error_log($e);
        }
    }
}
