<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    /**
     * Menampilkan dashboard UMKM dengan daftar produk milik user yang login.
     */
    public function dashboard()
    {
        \Log::info('Dashboard UMKM dipanggil oleh user ID: ' . auth()->id());
        // Pastikan relasi 'products' ada di model User
        $products = Auth::user()->products()->with('status')->latest()->get();
        return view('umkm_dashboard', compact('products'));
    }

    /**
     * Menampilkan form edit profil UMKM.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('umkmeditprofile', compact('user'));
    }

    /**
     * Menangani permintaan update profil UMKM.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi input user
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id, // hindari bentrok email
            'alamat' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
