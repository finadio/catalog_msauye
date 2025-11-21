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
        // Jika mengakses logout Filament, logout dan redirect ke home
        if ($request->is('filament/logout')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }

        // Jika belum login dan mengakses Filament, redirect ke Laravel login
        if (!Auth::check() && $request->is('filament*')) {
            return redirect()->route('login');
        }

        // Jika sudah login dan mengakses Filament
        if (Auth::check() && $request->is('filament*')) {
            $user = Auth::user();
            
            // Cek apakah user adalah admin dengan status active
            if ($user->role !== 'admin') {
                abort(403, 'Unauthorized access. Only admin can access this panel.');
            }
            
            if ($user->status !== 'active') {
                abort(403, 'Your admin account is not active. Please contact system administrator.');
            }
        }

        return $next($request);
    }
}
