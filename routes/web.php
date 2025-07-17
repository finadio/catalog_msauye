<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;

// Routing halaman publik
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/produk/{id}', [PublicController::class, 'produkDetail'])->name('produk.detail');
Route::get('/umkm/{id}', [PublicController::class, 'umkmDetail'])->name('umkm.detail');
Route::get('/artikel', [PublicController::class, 'artikel'])->name('artikel.index');
Route::get('/artikel/{id}', [PublicController::class, 'artikelDetail'])->name('artikel.detail');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store']);

// Daftar produk publik (bisa filter kategori, pencarian, dsb)
Route::get('/produk', [\App\Http\Controllers\PublicController::class, 'produkIndex'])->name('produk.index');

// Dashboard UMKM
Route::middleware(['auth', 'role:umkm'])->group(function () {
    Route::get('/umkm/dashboard', [\App\Http\Controllers\UmkmDashboardController::class, 'index'])->name('umkm.dashboard');
    Route::get('/umkm/profil', [\App\Http\Controllers\UmkmProfileController::class, 'edit'])->name('umkm.profil');
    Route::post('/umkm/profil', [\App\Http\Controllers\UmkmProfileController::class, 'update']);
    Route::resource('/umkm/produk', \App\Http\Controllers\UmkmProductController::class, [
        'as' => 'umkm'
    ]);
});

// Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/umkm', \App\Http\Controllers\AdminUmkmController::class, [ 'as' => 'admin' ]);
    Route::resource('/admin/produk', \App\Http\Controllers\AdminProductController::class, [ 'as' => 'admin' ]);
    Route::post('/admin/produk/{id}/approve', [\App\Http\Controllers\AdminProductController::class, 'approve'])->name('admin.produk.approve');
    Route::post('/admin/produk/{id}/reject', [\App\Http\Controllers\AdminProductController::class, 'reject'])->name('admin.produk.reject');
    Route::resource('/admin/kategori', \App\Http\Controllers\AdminCategoryController::class, [ 'as' => 'admin' ]);
    Route::resource('/admin/artikel', \App\Http\Controllers\AdminArticleController::class, [ 'as' => 'admin' ]);
    Route::resource('/admin/contact', \App\Http\Controllers\AdminContactController::class, [ 'as' => 'admin' ]);
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('umkm.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

Route::get('/redirect-by-role', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('umkm.dashboard');
    }
})->middleware(['auth']);
