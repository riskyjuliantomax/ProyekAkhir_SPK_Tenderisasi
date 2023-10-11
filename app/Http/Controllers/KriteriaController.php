<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Alert;
use Error;
use App\Http\Helper\KriteriaHelper;
use App\Models\Crips;
use App\Models\KriteriaCost;
use App\Models\RiwayatAktivitas;
use Exception;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    // Function untuk menampilkan data
    public function index(Request $request)
    {

        $lockKriteria = Kriteria::select('lock_kriteria')->groupBy('lock_kriteria')->first();
        if ($request->filled('search')) {
            $kriteria =  Kriteria::sortable()->where('nama_kriteria', 'like', "%" . $request->search . "%")->withCount('crips')->paginate(10);
            $title = 'Mencari Kriteria';
        } else {
            $kriteria = Kriteria::sortable()->orderBy('id_kriteria', 'desc')->withCount('crips')->paginate(10);
            $title = 'Kriteria';
        }
        // return response()->json($kriteria);
        return view('kriteria/index', compact('kriteria', 'title', 'lockKriteria'));
    }
    // Function untuk store ke tabel kriteria
    public function store(Request $request)
    {
        //Validasi Form
        request()->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
        ], [
            'nama_kriteria.required' => 'Form Nama Kriteria Harus Diisi',
            'bobot.required' => 'Form Bobot Harus Diisi',
        ]);
        try {
            $lockKriteria = Kriteria::select('lock_kriteria')->groupBy('lock_kriteria')->first();
            // echo $lockKriteria;
            if ($lockKriteria->lock_kriteria == 1) {
                // echo 'test';
                Alert::error('Gagal', 'Kriteria Tidak Boleh Di Edit Karena Lagi Kondisi Kunci');
                return redirect()->route('Kriteria.index');
            } else {
                $checkbobot = Kriteria::sum('bobot');
                $checkbobotfinal = $checkbobot + ($request->bobot / 100);
                if ($checkbobotfinal <= 1) {
                    //Checking if Exists DB
                    if (KriteriaCost::where('nama', $request->nama_kriteria)->exists()) {
                        $attribut = "cost";
                    } else {
                        $attribut = "benefit";
                    }
                    // // //Cara Penyimpanan Biasa
                    $Kriteria = Kriteria::create([
                        'nama_kriteria' => $request->nama_kriteria,
                        'bobot' => $request->bobot / 100,
                        'attribut' => $attribut,
                        'lock_kriteria' => 0,
                    ]);
                    if ($Kriteria) {
                        RiwayatAktivitas::create([
                            'id_users' => auth()->user()->id_users,
                            'deskripsi' => ' Menambahkan Kriteria ',
                            'deskripsi2' => ' Menambahkan Kriteria ' . $request->nama_kriteria,
                            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                            'role' => auth()->user()->role,
                        ]);

                        Alert::success('Berhasil', 'Data Kriteria Berhasil Disimpan');
                        return redirect()->route('Kriteria.index');
                    } else {
                        Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
                        return redirect()->route('Kriteria.index');
                    }
                } else {
                    Alert::error('Gagal', 'Nilai Bobot Tidak Boleh Lebih Dari 100%');
                    return redirect()->route('Kriteria.index');
                }
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
        }
    }

    // Function Untuk Update
    public function update(Request $request)
    {
        //Melakukan Validasi
        request()->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required',
        ], [
            'nama_kriteria.required' => 'Form Nama Kriteria Harus Diisi',
            'bobot.required' => 'Form Bobot Harus Diisi',
        ]);
        try {
            $lockKriteria = Kriteria::select('lock_kriteria')->groupBy('lock_kriteria')->first();
            // echo $lockKriteria;
            if ($lockKriteria->lock_kriteria == 1) {
                // echo 'test';
                Alert::error('Gagal', 'Kriteria Tidak Boleh Di Edit Karena Lagi Kondisi Kunci');
                return redirect()->route('Kriteria.index');
            } else {
                $checkbobot = Kriteria::sum('bobot');
                $Kriteria = Kriteria::find($request->id_kriteria);
                $checkbobot1 = $checkbobot - $Kriteria->bobot;
                $checkbobotfinal =  ($checkbobot1 + ($request->bobot / 100));
                // echo $checkbobotfinal;
                if ($checkbobotfinal <= 1) {
                    // Alert::error('Gagal', 'Nilai Bobot Tidak Boleh Kurang Dari 100%');
                    // return redirect()->route('Kriteria.index');
                    $oldKriteria = Kriteria::find($request->id_kriteria);
                    $Kriteria = Kriteria::find($request->id_kriteria);
                    $Kriteria->update([
                        'nama_kriteria' => $request->nama_kriteria,
                        'bobot' => $request->bobot / 100,
                        'attribut' => $request->attribut,
                    ]);
                    if ($Kriteria) {
                        RiwayatAktivitas::create([
                            'id_users' => auth()->user()->id_users,
                            'deskripsi' => ' Update Kriteria ',
                            'deskripsi2' => ' Update Kriteria ' . $request->nama_kriteria,
                            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                            'role' => auth()->user()->role,
                        ]);

                        Alert::success('Berhasil Update', 'Data Kriteria Berhasil Update');
                        return redirect()->route('Kriteria.index');
                    } else {
                        Alert::error('Gagal Update', 'Data Tidak Berhasil Update');
                        return redirect()->route('Kriteria.index')->with(['gagal' => 'Data Gagal Simpan']);
                    }
                } else {
                    Alert::error('Gagal', 'Nilai Bobot Tidak Boleh Lebih Dari 100%');
                    return redirect()->route('Kriteria.index');
                }
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
        }
    }
    public function edit($id_kriteria)
    {
        $kriteria = Kriteria::find($id_kriteria);
        // return response()->json($kriteria);
        return view('Kriteria.update', compact('kriteria'))->with([
            'title' => 'Edit Kriteria',
        ]);
    }
    // Show untuk Crips Per Kriteria
    public function show($id_kriteria, Request $request)
    {

        $data['lock_kriteria'] = Kriteria::select('lock_kriteria')->groupBy('lock_kriteria')->first();
        $data['crips'] = Crips::sortable()->where('id_kriteria', $id_kriteria)->orderBy('nilai', 'desc')->paginate(10);
        $data['kriteria'] = Kriteria::sortable()->findOrFail($id_kriteria);
        return view('Crips.index', compact('data'))->with([
            'title' => 'Crips',
        ]);
    }
    // Delete Kriteria By Id
    public function delete($id_kriteria)
    {
        $Kriteria = Kriteria::Find($id_kriteria);
        if ($Kriteria) {
            RiwayatAktivitas::create([
                'id_users' => auth()->user()->id_users,
                'deskripsi' =>  ' Hapus Kriteria ',
                'deskripsi2' =>  ' Hapus Kriteria ' . $Kriteria->nama_kriteria,
                'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                'role' => auth()->user()->role,
            ]);
        }
        $Kriteria->delete();
        return response()->json(['status' => 'Berhasil Hapus Kriteria']);
    }
    public function lock()
    {
        // Hitung Bobot
        $checkbobot = Kriteria::sum('bobot');
        // echo $checkbobotfinal;
        $kriteria = Kriteria::all();
        //Menghitung Kriteria
        $countKriteria = Kriteria::count('id_kriteria');
        //Variable untuk Full Crips
        $maxCrips = $countKriteria * 5;
        //Menghitung Kriteria Crips
        $countCrips = Crips::count('id_crips');
        //Check Validasi Apakah Bobot Belum 100%
        if ($checkbobot != 1) {
            Alert::error('Gagal', 'Tidak Bisa DiKunci Karena Bobot Belum 100%');
            return redirect()->route('Kriteria.index');
        }
        // End check Validasi
        //Check Validasi Apakah Belum Maksimal Crips
        if ($countCrips != $maxCrips) {
            Alert::error('Gagal', 'Tidak Bisa DiKunci Karena Crips Belum Terpenuhi');
            return redirect()->route('Kriteria.index');
        }
        // Endcheck Validasi
        //Variable Check Lock Kriteria
        $lockKriteria = Kriteria::select('lock_kriteria')->groupBy('lock_kriteria')->first();
        // echo $lockKriteria;
        //Kunci Kriteria Apabila Bobot Kriteria Sudah 100% Dan Crips Sudah Terpenuhi
        if ($checkbobot == 1 && $countCrips == $maxCrips) {
            if ($lockKriteria->lock_kriteria == 0) {
                foreach ($kriteria as $key) {
                    if ($key->lock_kriteria == 0) {
                        $Kriteria = Kriteria::where('lock_kriteria', '=', '0')->update(array('lock_kriteria' => 1));
                    }
                }
                return redirect()->route('Kriteria.index');
            }
        }
        // End Kunci Kriteria
        // Buka Kunci  Apabila Bobot Kriteria Sudah 100% Dan Crips Sudah Terpenuhi
        if ($lockKriteria->lock_kriteria == 1) {
            foreach ($kriteria as $key) {
                if ($key->lock_kriteria == 1) {
                    $Kriteria = Kriteria::where('lock_kriteria', '=', '1')->update(array('lock_kriteria' => 0));
                }
            }
            return redirect()->route('Kriteria.index');
        }
        // End Buka Kunci Kriteria
    }
}
