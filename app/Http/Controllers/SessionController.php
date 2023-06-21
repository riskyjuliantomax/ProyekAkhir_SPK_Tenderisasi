<?php

namespace App\Http\Controllers;

use App\Models\RiwayatAktivitas;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/Dashboard';
    protected function redirectTo()
    {
        if (Auth::check()) {
            return '/Dashboard';
        }
        return '/Dashboard';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('Sesi.login');
    }

    public function login(Request $request)
    {
        // Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        try {
            //Tangkap Data Email dan password dikirim oleh user
            $dataLogin = [
                'email' => $request->email,
                'password' => $request->password
            ];
            //Melakukan Authentication berdasarkan email dan password
            if (Auth::attempt($dataLogin)) {
                $userId = User::Find(auth()->user()->id_users);
                $userId->update(
                    [
                        'last_login' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]
                );
                RiwayatAktivitas::create([
                    'id_users' => auth()->user()->id_users,
                    'deskripsi' => ' Login',
                    'deskripsi2' =>  ' Telah Melakukan Login',
                    'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
                    'role' => auth()->user()->role,
                ]);

                if (Auth::check()) {
                    // return redirect('Dashboard');
                    return redirect('Dashboard')->with('sukses', 'Berhasil Login!');
                }
            } else {
                return redirect('login')->with(["login_gagal" => "Email Dan Password Salah"]);
            }
        } catch (Exception $e) {
            error_log($e);
            return redirect('login');
        }
    }

    public function logout()
    {
        $userId = User::Find(auth()->user()->id_users);
        $userId->update(
            [
                'last_logout' => \Carbon\Carbon::now()->toDateTimeString(),
            ]
        );
        RiwayatAktivitas::create([
            'id_users' => auth()->user()->id_users,
            'deskripsi' => ' Logout',
            'deskripsi2' => ' User Telah Melakukan Logout',
            'waktu' => \Carbon\Carbon::now()->toDateTimeString(),
            'role' => auth()->user()->role,
        ]);
        Auth::logout();
        return redirect('login')->with(["logout" => "Berhasil Logout"]);
    }
}
