<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PengunjungDashboardController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UmkmProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminDashboardController; // Controller Admin Dashboard yang baru
use App\Http\Controllers\AdminUmkmController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routing halaman publik
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/produk/{id}', [PublicController::class, 'produkDetail'])->name('produk.detail');;
Route::get('/umkm/{id}', [PublicController::class, 'umkmDetail'])->name('umkm.detail');
Route::get('/artikel', [PublicController::class, 'artikel'])->name('artikel.index');
Route::get('/artikel/{id}', [PublicController::class, 'artikelDetail'])->name('artikel.detail');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store']);

// Rute-rute yang memerlukan autentikasi (untuk semua peran)
Route::middleware('auth')->group(function () {
    // Rute Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Dashboard Pengunjung (jika tidak ada peran khusus, ini adalah dashboard default setelah login)
    // Route::get('/dashboard', [PengunjungDashboardController::class, 'index'])->name('dashboard'); // This line is commented out as per the edit hint
});


// Dashboard UMKM (Memerlukan autentikasi SAJA, tanpa middleware 'role' sementara)
Route::get('/umkm', function () {
    return redirect()->route('umkm.dashboard');
});
 Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/umkm/dashboard', [UmkmController::class, 'dashboard'])
    ->middleware('auth', 'role:umkm')
    ->name('umkm.dashboard');
    // Profil UMKM
    Route::get('/umkm/profil', [UmkmController::class, 'profil'])->name('umkm.profil');
    Route::put('/umkm/profil', [UmkmController::class, 'updateProfil'])->name('umkm.profil.update');
    Route::get('/umkm/profil', [UmkmProfileController::class, 'index'])->name('umkm.profil');
    // Produk UMKM
    Route::get('/umkm/products', [ProductController::class, 'index'])->name('umkm.products');
    Route::get('/umkm/products/create', [ProductController::class, 'create'])->name('umkm.products.create');
    Route::post('/umkm/products', [ProductController::class, 'store'])->name('umkm.products.store');
    Route::get('/umkm/products/{product}/edit', [ProductController::class, 'edit'])->name('umkm.products.edit');
    Route::put('/umkm/products/{product}', [ProductController::class, 'update'])->name('umkm.products.update');
    Route::delete('/umkm/products/{product}', [ProductController::class, 'destroy'])->name('umkm.products.destroy');
});

// Dashboard Admin (Memerlukan autentikasi SAJA, tanpa middleware 'role' sementara)
Route::middleware(['auth'])->group(function () {
    // Rute Dashboard Admin yang baru
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Rute-rute manajemen admin lainnya
    Route::resource('/admin/umkm', AdminUmkmController::class, [ 'as' => 'admin' ]);
    Route::resource('/admin/produk', AdminProductController::class, [ 'as' => 'admin' ]);
    Route::post('/admin/produk/{id}/approve', [AdminProductController::class, 'approve'])->name('admin.produk.approve');
    Route::post('/admin/produk/{id}/reject', [AdminProductController::class, 'reject'])->name('admin.produk.reject');
    Route::resource('/admin/kategori', AdminCategoryController::class, [ 'as' => 'admin' ]);
    Route::resource('/admin/artikel', AdminArticleController::class, [ 'as' => 'admin' ]);
    Route::resource('/admin/contact', AdminContactController::class, [ 'as' => 'admin' ]);
});

// Ini adalah rute-rute autentikasi bawaan Laravel Breeze
require __DIR__.'/auth.php';

// Route untuk redirect setelah login, sesuaikan agar pengunjung diarahkan ke dashboard yang sesuai peran
// Middleware 'auth' tetap dipertahankan, tetapi logika redirect akan tetap berfungsi
Route::get('/redirect-by-role', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'umkm') {
        return redirect()->route('umkm.dashboard');
    } else {
        // Asumsi peran selain admin/umkm adalah pengunjung
        return redirect()->route('dashboard'); // Arahkan ke dashboard pengunjung
    }
})->middleware(['auth']);

Route::get('/tes-umkm', function () {
    return 'Route UMKM bisa diakses';
});


