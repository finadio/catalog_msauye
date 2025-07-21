<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
class UmkmProfileController extends Controller
{
    public function edit()
    {
        $umkm = \App\Models\Umkm::where('user_id', auth()->id())->firstOrFail();

        // Ambil semua produk milik UMKM ini
        $products = $umkm->products ?? collect(); // jika relasi belum ada, fallback ke collection kosong

        return view('umkm_editprofile', compact('umkm', 'products'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

    $validated = $request->validate([
        'nama_usaha' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'lokasi' => 'nullable|string',
        'kontak_wa' => 'nullable|string',
        'kontak_ig' => 'nullable|string',
        'kontak_tiktok' => 'nullable|string',
    ]);

    $user->update($validated);

    return redirect()->route('umkm_editprofile')->with('success', 'Profil berhasil diperbarui.');
    }
}
