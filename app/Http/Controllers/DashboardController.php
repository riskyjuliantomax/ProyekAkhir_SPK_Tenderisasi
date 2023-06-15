<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::orderBy('nama_kriteria', 'ASC')->get();
        $alternatif = Perusahaan::with('penilaian.crips')->get();
        $penilaian = Penilaian::with('crips', 'alternatif')->get();

        return view('Dashboard.index', compact('kriteria', 'penilaian'))->with(['title' => 'Dashboard SPK Tenderisasi']);
    }

    public function Error405()
    {
        return view('errors.405');
    }
}
