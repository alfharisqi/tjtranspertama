<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Throwable;

class Handler extends ExceptionHandler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // Redirect to email verification if accessing routes that require it
        if ($request->is('print') || $request->is('printpdf') || $request->is('complaints/*') || $request->is('dashboard') || $request->is('orders/*') || $request->is('transactions/*') || $request->is('trains/*') || $request->is('types/*') || $request->is('tracks/*') || $request->is('tickets/*') || $request->is('prices/*') || $request->is('methods/*') || $request->is('users/*')) {
            return Redirect::guest(URL::route('verification.notice'));
        }

        return Redirect::guest(URL::route('login'));
    }
    
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
