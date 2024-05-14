<?php

namespace Illuminate\Routing\Middleware;

use Closure;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Arr;

class ValidateSignature
{
    /**
     * The names of the parameters that should be ignored.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * Specify that the URL signature is for a relative URL.
     *
     * @param  array|string  $except
     * @return string
     */
    public static function relative($except = [])
    {
        $except = Arr::wrap($except);

        return static::class.':'.implode(',', empty($except) ? ['relative'] : ['relative',  ...$except]);
    }

    /**
     * Specify that the URL signature is for an absolute URL.
     *
     * @param  array|string  $except
     * @return class-string
     */
    public static function absolute($except = [])
    {
        $except = Arr::wrap($except);

        return empty($except)
            ? static::class
            : static::class.':'.implode(',', $except);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array|null  $args
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Routing\Exceptions\InvalidSignatureException
     */
    public function handle($request, Closure $next, ...$args)
    {
        [$relative, $except] = $this->parseArguments($args);

        if ($request->hasValidSignatureWhileIgnoring($except, ! $relative)) {
            return $next($request);
        }

        throw new InvalidSignatureException;
    }

    /**
     * Parse the additional arguments given to the middleware.
     *
     * @param  array  $args
     * @return array
     */
    protected function parseArguments(array $args)
    {
        $relative = ! empty($args) && $args[0] === 'relative';

        if ($relative) {
            array_shift($args);
        }

        $except = array_merge(
            $this->except,
            $args
        );

        return [$relative, $except];
    }
}

