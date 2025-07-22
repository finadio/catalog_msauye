<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan tampilan login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Tangani permintaan autentikasi yang masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Mengarahkan pengguna berdasarkan peran mereka
        if ($user->role === 'admin') {
            // Perbaikan: Menggunakan 'admin.dashboard' sesuai dengan definisi rute di web.php
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } elseif ($user->role === 'umkm') {
            return redirect()->intended(route('umkm_dashboard', absolute: false));
        } else {
            // Jika ada peran lain atau tidak terdefinisi, arahkan ke dashboard umum
            return redirect()->intended(route('dashboard', absolute: false));
        }
    }

    /**
     * Hancurkan sesi autentikasi pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

