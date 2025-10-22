<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FilamentAuthRedirect
{
    /**
     * Handle an incoming request.
     *
     * Redirect user yang mencoba akses Filament tapi belum login ke Laravel login page.
     * Setelah login, redirect otomatis berdasarkan role di AuthenticatedSessionController.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login dan mengakses Filament
        if (!Auth::check() && $request->is('filament*')) {
            return redirect()->route('login');
        }

        // Jika sudah login tapi bukan admin
        if (Auth::check() && $request->is('filament*')) {
            $user = Auth::user();
            
            // Cek apakah user adalah admin dengan status approved
            if ($user->role !== 'admin' || $user->status !== 'approved') {
                abort(403, 'Unauthorized access. Only approved admin can access this panel.');
            }
        }

        return $next($request);
    }
}
