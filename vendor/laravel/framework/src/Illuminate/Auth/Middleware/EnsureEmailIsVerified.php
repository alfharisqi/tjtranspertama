<?php

namespace Illuminate\Auth\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureEmailIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        // Memeriksa apakah pengguna telah diotentikasi
        if (! $request->user()) {
            Log::info('User not authenticated');
            return $next($request);
        }

        // Memeriksa apakah pengguna merupakan instance dari MustVerifyEmail dan belum memverifikasi email
        if ($request->user() instanceof MustVerifyEmail && ! $request->user()->hasVerifiedEmail()) {
            Log::info('User not verified, redirecting to verification notice');
            // Memeriksa apakah permintaan adalah JSON
            if ($request->expectsJson()) {
                Log::info('User not verified, JSON request, aborting with 403');
                return abort(403, 'Your email address is not verified.');
            }

            // Mengarahkan pengguna ke halaman verifikasi email
            return Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        }

        Log::info('User verified, proceeding to next request');
        return $next($request);
    }
}

