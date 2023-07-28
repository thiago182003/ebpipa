<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmpresaAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('empresa')->check() && Auth::guard('empresa')->user()) {
            return $next($request);
        } else {
            if (!Auth::guard('empresa')->check()) {
                return redirect('login');
            }
            dd("sem acesso");
        }
    }
}
