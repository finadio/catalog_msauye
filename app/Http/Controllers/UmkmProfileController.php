<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Umkm;

class UmkmProfileController extends Controller
{
    public function index()
    {
        return view('umkm.profil'); // <-- ini menuju ke resources/views/umkm/profil.blade.php
    }
    
    public function edit()
    {
        $umkm = auth()->user()->umkm;
        return view('umkm.profil', compact('umkm'));
    }

    public function update(Request $request)
    {
        $umkm = auth()->user()->umkm;
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'whatsapp' => 'nullable',
            'instagram' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);
        $data = $request->only(['name','description','address','phone','whatsapp','instagram']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('umkm','public');
        }
        $umkm->update($data);
        return redirect()->back()->with('success','Profil UMKM berhasil diperbarui!');
    }
}
