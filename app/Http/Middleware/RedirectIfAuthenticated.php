<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect()->intended('/'); // Arahkan ke halaman home jika sudah terotentikasi
            }
        }

        // Jika pengguna belum terautentikasi dan mencoba mengakses halaman login atau register
        // maka biarkan mereka mengaksesnya
        if ($request->is('login') || $request->is('register')) {
            return $next($request);
        }

        // Tambahkan pengecualian untuk rute /checkprice
        if ($request->is('checkprice')) {
            return $next($request);
        }

        return $next($request);
    }
}
