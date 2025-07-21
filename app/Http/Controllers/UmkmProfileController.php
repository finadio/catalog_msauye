<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmkmProfileController extends Controller
{
    public function edit()
    {
        return view('umkmeditprofile');
    }

    public function update(Request $request)
    {
        // Validasi dan simpan profil UMKM
        return redirect()->route('umkm.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
}
