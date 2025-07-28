<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Umkm;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan halaman registrasi.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Proses permintaan registrasi pengguna.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Validasi UMKM
            'umkm_name' => ['required', 'string', 'max:255'],
            'business_type' => ['required', 'string', 'max:100'],
            'umkm_address' => ['required', 'string', 'max:255'],
            'umkm_phone' => ['required', 'string', 'max:20'],
        ]);

        // Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Simpan UMKM baru yang terkait user
        Umkm::create([
            'user_id' => $user->id,
            'name' => $request->umkm_name,
            'business_type' => $request->business_type,
            'address' => $request->umkm_address,
            'phone' => $request->umkm_phone,
            'description' => 'Deskripsi belum diisi.', // Set default jika tidak ada input dari user
        ]);

        // Trigger event Laravel untuk pendaftaran
        event(new Registered($user));

        // Redirect ke halaman login dengan notifikasi sukses
        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silakan login.');
    }
}
