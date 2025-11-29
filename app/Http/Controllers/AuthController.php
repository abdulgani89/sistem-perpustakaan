<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    // ---- PROSES LOGIN ----
    public function authAdmin(Request $req)
    {
        if ($req->username == "admin" && $req->password == "admin123") {
            Session::put('role', 'admin');
            return redirect()->route('index-admin');
        }
        return back()->with('error', 'Username atau password admin salah');
    }

    public function authKepala(Request $req)
    {
        if ($req->id_kepala == "KPL001" && $req->password == "kepala123") {
            Session::put('role', 'kepala');
            return redirect()->route('kepala.dashboard');
        }
        return back()->with('error', 'ID Kepala atau password salah');
    }

    public function authSiswa(Request $req)
    {
        if ($req->nis == "12345" && $req->password == "siswa123") {
            Session::put('role', 'siswa');
            return redirect()->route('siswa.index');
        }
        return back()->with('error', 'NIS atau password salah');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login.utama');
    }
}
