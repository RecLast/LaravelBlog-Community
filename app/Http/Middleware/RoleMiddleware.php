<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || !$request->user()->roles()->where('name', $role)->exists()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}