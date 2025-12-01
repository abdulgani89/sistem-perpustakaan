<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkKepalaAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('id_user') || session('role') !== 'kepala') {
            return redirect()->route('login.kepala')
                             ->with('error', 'Anda harus login sebagai kepala perpus untuk mengakses halaman ini.');
        }
        return $next($request);
    }
}