<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        if (Session::get('role') !== 'admin') {
            return redirect()->route('login.admin');
        }

        return view('admin-page.dashboard');
    }
}
