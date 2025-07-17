<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Debugging step 1: Periksa apakah user terautentikasi
        if (!Auth::check()) {
            dd('Middleware: User NOT Authenticated'); // Jika ini muncul, user belum login atau sesi hilang
        }

        $user = Auth::user(); // Dapatkan user yang sedang login

        // Debugging step 2: Periksa role user yang terautentikasi
        dd('Middleware: User Authenticated. User Role:', $user->role, 'Expected Roles:', $roles);
        // Jika ini muncul, perhatikan nilai $user->role dan $roles

        if (!in_array($user->role, $roles)) {
            // Jika baris ini tereksekusi, berarti role tidak cocok
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}