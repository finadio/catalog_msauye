<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PengunjungDashboardController;
use App\Http\Controllers\UmkmDashboardController;
use App\Http\Controllers\UmkmProfileController;
use App\Http\Controllers\UmkmProductController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUmkmController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminContactController;

// --------------------
// Halaman Publik
// --------------------
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/produk', [PublicController::class, 'produkIndex'])->name('produk.index');
Route::get('/produk/{id}', [PublicController::class, 'produkDetail'])->name('produk.detail');
Route::get('/umkm/{id}', [PublicController::class, 'umkmDetail'])->name('umkm.detail');
Route::get('/artikel', [PublicController::class, 'artikel'])->name('artikel.index');
Route::get('/artikel/{id}', [PublicController::class, 'artikelDetail'])->name('artikel.detail');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store']);

// --------------------
// Otentikasi & Profil
// --------------------
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard untuk pengunjung biasa (tanpa role)
    Route::get('/dashboard', [PublicController::class, 'index'])->name('dashboard');
});

// --------------------
// UMKM
// --------------------
Route::middleware(['auth', 'role:umkm'])->prefix('umkm')->name('umkm.')->group(function () {
    Route::get('/dashboard', [UmkmDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [UmkmProfileController::class, 'edit'])->name('profil');
    Route::post('/profil', [UmkmProfileController::class, 'update']);
    Route::resource('/produk', UmkmProductController::class);
});

// --------------------
// Admin
// --------------------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/umkm', AdminUmkmController::class);
    Route::resource('/produk', AdminProductController::class);
    Route::post('/produk/{id}/approve', [AdminProductController::class, 'approve'])->name('produk.approve');
    Route::post('/produk/{id}/reject', [AdminProductController::class, 'reject'])->name('produk.reject');
    Route::resource('/kategori', AdminCategoryController::class);
    Route::resource('/artikel', AdminArticleController::class);
    Route::resource('/contact', AdminContactController::class);
});

// --------------------
// Autentikasi Laravel Breeze/Fortify
// --------------------
require __DIR__.'/auth.php';

// --------------------
// Redirect berdasarkan peran
// --------------------
Route::get('/redirect-by-role', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'umkm') {
        return redirect()->route('umkm.dashboard');
    } else {
        return redirect()->route('dashboard');
    }
})->middleware(['auth']);

