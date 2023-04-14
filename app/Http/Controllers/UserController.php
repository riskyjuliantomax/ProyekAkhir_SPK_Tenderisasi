<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Alert;
use App\Models\UserAlamat;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id_users', 'desc')->paginate(10);
        return view('User.index', compact('user'))
            ->with(['title' => 'User']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'email' => ['required'],
            'no_hp' => ['required', 'max:13'],
            'tanggal_lahir' => ['required'],
            'tempat_lahir' => ['required'],
            'password' => ['required'],
            'kenegaraan' => ['required'],
            'provinsi' => ['required'],
            'kabupaten' => ['required'],
            'kecamatan' => ['required'],
            'kota' => ['required'],
            'kodepos' => ['required'],
            'alamat' => ['required']
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
                        'no_hp' => $request->no_hp,
                        'role' => $request->role,
                        'tgl_lahir' => $request->tanggal_lahir,
                        'tempat_lahir' => $request->tempat_lahir,
                        'kelamin' => $request->kelamin_user,
                        'password' => $request->password,
                        'img_profile' => $photoProfile->hashName(),
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                    UserAlamat::create([
                        'id_users' => $userId,
                        'kenegaraan' => $request->kenegaraan,
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
                        'no_hp' => $request->no_hp,
                        'role' => $request->role,
                        'tgl_lahir' => $request->tanggal_lahir,
                        'tempat_lahir' => $request->tempat_lahir,
                        'kelamin' => $request->kelamin_user,
                        'password' => $request->password,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                    UserAlamat::create([
                        'id_users' => $userId,
                        'kenegaraan' => $request->kenegaraan,
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
            Log::error($e);
            Alert::error('Gagal', 'Data User Tidak Berhasil Disimpan');
            return redirect()->route('User.index');
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'email' => ['required'],
            'no_hp' => ['required', 'max:13'],
            'tanggal_lahir' => ['required'],
            'tempat_lahir' => ['required'],
            'password' => ['required'],
            'kenegaraan' => ['required'],
            'provinsi' => ['required'],
            'kabupaten' => ['required'],
            'kecamatan' => ['required'],
            'kota' => ['required'],
            'kodepos' => ['required'],
            'alamat' => ['required']
        ]);
        try {
            DB::transaction(function () use ($request) {
                $timeupdate = \Carbon\Carbon::now()->toDateTimeString();
                $user = User::find($request->id);
                if ($request->password == null || $request->password == '') {
                    $user->update([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'role' => $request->role,
                        'tgl_lahir' => $request->tanggal_lahir,
                        'tempat_lahir' => $request->tempat_lahir,
                        'kelamin' => $request->kelamin_user,
                        'updated_at' => $timeupdate,
                    ]);
                } else {
                    $user->update([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'no_hp' => $request->no_hp,
                        'password' => $request->password,
                        'role' => $request->role,
                        'tgl_lahir' => $request->tanggal_lahir,
                        'tempat_lahir' => $request->tempat_lahir,
                        'kelamin' => $request->kelamin_user,
                        'updated_at' => $timeupdate,
                    ]);
                }
                $userAlamat = UserAlamat::find($request->id_useralamat);
                $userAlamat->update([
                    'id_users' => $request->id,
                    'kenegaraan' => $request->kenegaraan,
                    'provinsi' => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'kecamatan' => $request->kecamatan,
                    'kota' => $request->kota,
                    'kodepos' => $request->kodepos,
                    'alamat' => $request->alamat
                ]);
            });
            Alert::success('Berhasil', 'Data User Berhasil Disimpan');
            return redirect()->route('User.index');
        } catch (Exception $e) {
            Log::error($e);
            Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
            return redirect()->route('User.index');
        };
        // if($User && $UserAlamat){
        //     Alert::success('Berhasil', 'Data User Berhasil Disimpan');
        //     return redirect()->route('User.index');
        // }else {
        //     Alert::error('Gagal', 'Data Tidak Berhasil Disimpan');
        //     return redirect()->route('User.index');
        // }
    }

    public function delete($id_user)
    {
        $user = User::Find($id_user);
        $user->delete();
        return response()->json(['status' => 'Berhasil Hapus Kriteria']);
    }
}
