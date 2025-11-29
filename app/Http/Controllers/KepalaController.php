<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class KepalaController extends Controller
{
    public function index()
    {
        if (Session::get('role') !== 'kepala') {
            return redirect()->route('login.kepala');
        }

        return view('kepala-page.kepala-dashboard');
    }
}
