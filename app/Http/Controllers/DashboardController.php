<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
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
        return view('Dashboard/index')->with(['title' => 'Dashboard SPK Tenderisasi']);
    }

    public function Error405()
    {
        return view('errors.405');
    }
}
