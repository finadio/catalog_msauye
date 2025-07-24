<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Umkm; // Tambahkan ini untuk model Umkm
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,umkm,user'], // Pastikan role divalidasi
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Simpan role yang dipilih
        ]);

        // Jika role adalah 'umkm', buat entri di tabel umkms
        if ($user->role === 'umkm') {
            Umkm::create([
                'user_id' => $user->id,
                'name' => $user->name . ' UMKM', // Nama UMKM default
                'description' => 'Deskripsi UMKM default',
                'address' => 'Alamat UMKM default',
                'phone' => '08xxxxxxxxxx',
                'whatsapp' => null,
                'instagram' => null,
                'tiktok' => null,
                'website' => null,
            ]);
        }

        event(new Registered($user));

        Auth::login($user); // Login otomatis setelah registrasi

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin_dashboard');
        } elseif ($user->role === 'umkm') {
            return redirect()->route('umkm_dashboard');
        } else {
            return redirect(route('dashboard', absolute: false));
        }
    }
}

