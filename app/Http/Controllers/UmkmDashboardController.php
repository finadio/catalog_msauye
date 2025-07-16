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
        $myProductCount = $umkm ? $umkm->products()->count() : 0;
        $pendingCount = $umkm ? $umkm->products()->whereHas('status', function($q){ $q->where('name', 'pending'); })->count() : 0;
        return view('umkm.dashboard', compact('myProductCount', 'pendingCount'));
    }
}
