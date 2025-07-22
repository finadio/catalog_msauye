<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\Product;
class UmkmProfileController extends Controller
{
    public function edit()
    {
        $umkm = Umkm::where('user_id', auth()->id())->first();

        // Ambil semua produk milik UMKM ini
        $products = Product::where('umkm_id', $umkm->id)->with('status')->get();

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
