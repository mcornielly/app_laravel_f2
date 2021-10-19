<?php

namespace App\Http\Middleware;

use Closure;

class VerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->has('verify:request_id')) {
            return back();
        }

        return $next($request);
    }
}
