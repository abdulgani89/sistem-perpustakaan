<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginUtama()
    {
        return view('login-utama.login');
    }

    public function loginAdmin()
    {
        return view('auth.login_admin');
    }

    public function loginKepala()
    {
        return view('auth.login_kepala');
    }

    public function loginSiswa()
    {
        return view('auth.login_siswa');
    }

    public function authAdmin(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $req->username)
                    ->where('role', 'admin')
                    ->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return back()->with('error', 'Username atau password admin salah');
        }

        session([
            'id_user' => $user->id_user,
            'username' => $user->username,
            'role' => 'admin',
        ]);

        return redirect()->route('index-admin');
    }

    public function authKepala(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $req->username)
                    ->where('role', 'kepala')
                    ->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return back()->with('error', 'Username atau password admin salah');
        } 

        session([
            'id_user' => $user->id_user,
            'username' => $user->username,
            'role' => 'kepala',
        ]);

        return redirect()->route('kepala.index');
    }

    public function authSiswa(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required', 
        ]);

        $user = User::where('username', $req->username)
                    ->where('role', 'siswa')
                    ->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return back()->with('error', 'Username atau password siswa salah');
        }

        $siswa = Siswa::where('id_user', $user->id_user)->first();

        session([
            'id_user' => $user->id_user,
            'id_siswa' => $siswa->id_siswa,
            'username' => $user->username,
            'nama_siswa' => $siswa->nama_siswa,
            'role' => 'siswa',
        ]);

        return redirect()->route('siswa.index');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login.utama');
    }
}
