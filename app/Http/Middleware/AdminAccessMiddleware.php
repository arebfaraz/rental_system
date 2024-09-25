<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccessMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user || !$user->roles->count() || $user->hasRole(['tenant', 'landlord'])) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
