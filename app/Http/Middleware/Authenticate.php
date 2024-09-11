<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->guest()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Sesión expirada. Redirigiendo al login.'], 401);
            } else {
                return redirect()->guest(route('login'))->with('status', 'Su sesión ha expirado.');
            }
        }
        return $next($request);
    }
}
