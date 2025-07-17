<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UmkmDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $umkm = $user->umkm ?? null;
        if (!$umkm) {
            // Jika user tidak punya relasi umkm, redirect ke home atau tampilkan pesan error
            return redirect('/')->withErrors(['umkm' => 'Akun Anda belum terdaftar sebagai UMKM.']);
        }
        $myProductCount = $umkm->products()->count();
        $pendingCount = $umkm->products()->whereHas('status', function($q){ $q->where('name', 'pending'); })->count();
        return view('umkm.dashboard', compact('myProductCount', 'pendingCount'));
    }
}
