<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use App\Models\UserAlamat;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $user = User::where('nama', 'like', "%" . $request->search . "%")
                ->orWhere('email', 'like', "%" . $request->search)
                ->orWhere('role', 'like', "%" . $request->search)
                ->orWhere('nip', 'like', "%" . $request->search)
                ->paginate(10);
        } else {
            $user = User::orderBy('id_users', 'desc')->paginate(10);
        }
        return view('User.index', compact('user'))
            ->with(['title' => 'User']);
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required|min:5',
            'nip' => 'required'
        ], [
            'nama.required' => 'Form Nama Harus Diisi',
            'email.required' => 'Form Email Harus Diisi',
            'password.required' => 'Form Password Harus Diisi',
            'nip.required' => 'Form Nip Harus Diisi',
            'password.min' => 'Password Minimal 5 Huruf'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $now =  \Carbon\Carbon::now()->toDateTimeString();
                if ($request->file('photoFile') != "" || $request->file('photoFile') != null) {
                    $photoProfile = $request->file('photoFile');
                    $photoProfile->storeAs('public/photoProfileUser', $photoProfile->hashName());
                    $userId = User::insertGetId([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'nip' => $request->nip,
                        'no_hp' => $request->no_hp,
                        'role' => $request->role,
                        'tgl_lahir' => $request->tanggal_lahir,
                        'tempat_lahir' => $request->tempat_lahir,
                        'kelamin' => $request->kelamin_user,
                        'password' => Hash::make($request->password),
                        'img_profile' => $photoProfile->hashName(),
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                    UserAlamat::create([
                        'id_users' => $userId,
                        'provinsi' => $request->provinsi,
                        'kabupaten' => $request->kabupaten,
                        'kecamatan' => $request->kecamatan,
                        'kota' => $request->kota,
                        'kodepos' => $request->kodepos,
                        'alamat' => $request->alamat
                    ]);
                } else {
                    $userId = User::insertGetId([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'nip' => $request->nip,
                        'no_hp' => $request->no_hp,
                        'role' => $request->role,
                        'tgl_lahir' => $request->tanggal_lahir,
                        'tempat_lahir' => $request->tempat_lahir,
                        'kelamin' => $request->kelamin_user,
                        'password' => Hash::make($request->password),
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                    UserAlamat::create([
                        'id_users' => $userId,
                        'provinsi' => $request->provinsi,
                        'kabupaten' => $request->kabupaten,
                        'kecamatan' => $request->kecamatan,
                        'kota' => $request->kota,
                        'kodepos' => $request->kodepos,
                        'alamat' => $request->alamat
                    ]);
                }
            });
            Alert::success('Berhasil', 'Data User Berhasil Disimpan');
            return redirect()->route('User.index');
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data User Tidak Berhasil Disimpan');
            return redirect()->route('User.index');
        }
    }

    public function update(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'email' => 'required',
            'nip' => 'required'
        ], [
            'nama.required' => 'Form Nama Harus Diisi',
            'email.required' => 'Form Email Harus Diisi',
            'nip.required' => 'Form Nip Harus Diisi',
        ]);

        try {
            $timeupdate = \Carbon\Carbon::now()->toDateTimeString();
            //Cari user berdasarkan Id
            if ($request->id != null || $request->id != '') {
                $user = User::find($request->id);
            }
            //Apakah user input password
            if ($request->password != null || $request->password != '') {
                $user->password = Hash::make($request->password);
            }
            // Apakah user upload gambar profile
            if ($request->file('photoFile') != "" || $request->file('photoFile') != null) {
                $photoProfile = $request->file('photoFile');
                $photoProfile->storeAs('public/photoProfileUser', $photoProfile->hashName());
                $user->img_profile = $photoProfile->hashName();
            }
            // melakukan update
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->nip = $request->nip;
            $user->no_hp = $request->no_hp;
            $user->role = $request->role;
            $user->tgl_lahir = $request->tanggal_lahir;
            $user->tempat_lahir = $request->tempat_lahir;
            $user->kelamin = $request->kelamin;
            $user->updated_at = $timeupdate;
            $user->save();

            $userAlamat = UserAlamat::find($request->id_useralamat);
            $userAlamat->update([
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'kodepos' => $request->kodepos,
                'alamat' => $request->alamat
            ]);

            if ($request->id != null || $request->id != '') {
                Alert::success('Berhasil', 'Data User Berhasil Update');
                return redirect()->route('User.index');
            }
            if ($request->email_auth != null || $request->email_auth  != '') {
                Alert::success('Berhasil', 'Data Profile Berhasil Update');
                return redirect()->route('User.profile');
            }
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return redirect()->route('User.index');
        };
    }

    public function delete($id_user)
    {
        $user = User::Find($id_user);
        $user->delete();
        return response()->json(['status' => 'Berhasil Hapus Kriteria']);
    }

    public function profile()
    {
        $user = User::where('email', Auth()->user()->email)->get();
        // return response()->json($user);
        return view('User.profile', compact('user'))
            ->with(['title' => 'User']);
    }

    public function profile_update(Request $request)
    {
        // return response()->json($request);
        request()->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Form Nama Harus Diisi',
        ]);

        try {
            $timeupdate = \Carbon\Carbon::now()->toDateTimeString();
            //Cari user berdasarkan auth
            $user = User::find(Auth()->user()->id_users);
            // Apakah user input password
            if ($request->password != null || $request->password != '') {
                $user->password = Hash::make($request->password);
            }
            // Apakah user upload gambar profile
            if ($request->file('photoFile') != "" || $request->file('photoFile') != null) {
                $photoProfile = $request->file('photoFile');
                $photoProfile->storeAs('public/photoProfileUser', $photoProfile->hashName());
                $user->img_profile = $photoProfile->hashName();
            }
            // melakukan update
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->nip = $request->nip;
            $user->tentang = $request->tentang;
            $user->no_hp = $request->no_hp;
            $user->tgl_lahir = $request->tanggal_lahir;
            $user->tempat_lahir = $request->tempat_lahir;
            $user->kelamin = $request->kelamin;
            $user->updated_at = $timeupdate;
            $user->save();

            $userAlamat = UserAlamat::where('id_users', Auth()->user()->id_users);
            // return response()->json($userAlamat);
            $userAlamat->update([
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'kodepos' => $request->kodepos,
                'alamat' => $request->alamat
            ]);

            Alert::success('Berhasil', 'Data Profile Berhasil Update');
            return redirect()->route('User.profile');
        } catch (Exception $e) {
            error_log($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return redirect()->route('User.profile');
        };
    }
}
