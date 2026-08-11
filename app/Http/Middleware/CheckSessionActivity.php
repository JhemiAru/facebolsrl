<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if ($request->session()->has('last_activity')) {
            $maxIdleTime = (config('session.lifetime') - 1) * 60; // 1 minuto antes de expirar
            
            if (time() - $request->session()->get('last_activity') > $maxIdleTime) {
                $request->session()->flush();
                return redirect()->guest(route('login'))
                    ->with('status', 'Sesión expirada por inactividad');
            }
        }
        
        $request->session()->put('last_activity', time());
        return $next($request);
    }
}
