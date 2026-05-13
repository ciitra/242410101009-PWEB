<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role !== 'owner') {
            abort(403, 'Akses Ditolak! Halaman ini hanya untuk owner.');
        }

        return $next($request);
    }
}
