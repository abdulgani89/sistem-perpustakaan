<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkSiswaAuth
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
        if(!session()->has('id_siswa') || session('role') !== 'siswa'){
            return redirect()->route('siswa.login')
                             ->with ('error', 'Anda harus login sebagai siswa untuk mengakses halaman ini.');
        }
        return $next($request);
    }
}
