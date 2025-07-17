<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Redirect to login if user is not authenticated
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if the authenticated user has any of the required roles
        if (!in_array($user->role, $roles)) {
            // If the user does not have the required role, abort with 403 Forbidden
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}