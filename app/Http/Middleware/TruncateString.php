<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TruncateString
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();

        foreach ($input as $key => $value) {
            if (is_string($value)) {
                $input[$key] = substr($value, 0, 255);
            }
        }

        $request->merge($input);

        return $next($request);
    }
}
