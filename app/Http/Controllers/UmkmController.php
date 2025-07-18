<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;

class UMKMController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Pastikan user sudah punya data UMKM
        $umkm = $user->umkm ?? null;

        if (!$umkm) {
            return redirect()->route('home')->withErrors([
                'umkm' => 'Akun Anda belum terdaftar sebagai UMKM.'
            ]);
        }

        $myProductCount = $umkm->products()->count();
        $pendingCount = $umkm->products()->whereHas('status', function ($q) {
            $q->where('name', 'pending');
        })->count();

        return view('umkm.dashboard', compact('myProductCount', 'pendingCount'));
    }

    public function profile()
    {
        $user = auth()->user();
        $umkm = $user->umkm;

        return view('umkm.profile', compact('umkm'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $user = auth()->user();
        $umkm = $user->umkm;

        $umkm->update($request->only('nama_umkm', 'alamat', 'deskripsi'));

        return redirect()->route('umkm.profile')->with('success', 'Profil UMKM berhasil diperbarui.');
    }
}
