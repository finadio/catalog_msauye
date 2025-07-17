<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm; // Pastikan model Umkm di-import

class UmkmDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $umkm = $user->umkm ?? null;

        if (!$umkm) {
            // Jika baris ini tereksekusi, berarti $user->umkm masih null
            return redirect('/')->withErrors(['umkm' => 'Akun Anda belum terdaftar sebagai UMKM.']);
        }

        $myProductCount = $umkm->products()->count();
        $pendingCount = $umkm->products()->whereHas('status', function($q){ $q->where('name', 'pending'); })->count();

        return view('umkm.dashboard', compact('myProductCount', 'pendingCount'));
    }
}