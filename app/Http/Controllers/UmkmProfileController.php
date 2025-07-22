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
    $user = auth()->user(); // atau Auth::user();
    $umkm = $user->umkm; // pastikan ada relasi User -> UMKM

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'phone' => 'nullable|string|max:20',
        'whatsapp' => 'nullable|string|max:20',
        'instagram' => 'nullable|string|max:100',
        'tiktok' => 'nullable|string|max:100',
        'website' => 'nullable|url|max:255',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($umkm->photo) {
            Storage::delete('public/' . $umkm->photo);
        }

        $validated['photo'] = $request->file('photo')->store('umkm_photos', 'public');
    }

    $umkm->update($validated);

    return redirect()->route('umkm_editprofile')->with('success', 'Profil berhasil diperbarui!');
    }
}