<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionExpiryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->expectsJson()) {
            return $next($request);
        }

        $wasAuthenticated = (bool) $request->session()->get('was_authenticated', false);
        if (!auth()->check() && $wasAuthenticated) {
            // Clear the flag to avoid loop
            $request->session()->forget('was_authenticated');
            return response()->view('errors.session-expired', [], 440);
        }

        return $next($request);
    }
}

