<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || ! $request->user()->roles()->where('name', $role)->exists()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}