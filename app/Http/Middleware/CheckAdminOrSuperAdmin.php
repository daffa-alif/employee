<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminOrSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Allow access if the user is an Admin or SuperAdmin
        if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Deny access for other roles
        abort(403, 'Unauthorized action.');
    }
}