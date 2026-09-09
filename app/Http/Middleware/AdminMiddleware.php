<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('is_admin')) {
            return redirect()->route('login')->with('error', 'You must be logged in as an admin to access this page.');
        }

        return $next($request);
    }
}