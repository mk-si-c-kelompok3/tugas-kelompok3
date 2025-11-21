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
        // kalau belum login, lempar ke login
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // kalau role BUKAN admin, kasih error 403 / boleh juga redirect
        if ($request->user()->role !== 'admin') {
            abort(403, 'Akses khusus admin.');
            // atau kalau mau redirect:
            // return redirect()->route('pengaduan.index')->with('error', 'Hanya admin yang boleh mengakses.');
        }

        return $next($request);
    }
}
