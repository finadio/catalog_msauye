<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PengunjungDashboardController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\UmkmProfileController;
use App\Http\Controllers\UmkmProductController;
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
Route::get('/produk', [PublicController::class, 'produkIndex'])->name('produk.index'); // Tambahkan baris ini
Route::get('/produk/{id}', [PublicController::class, 'produkDetail'])->name('produk.detail');
Route::get('/umkm', [PublicController::class, 'umkmIndex'])->name('public.umkm_index');
Route::get('/umkm/{id}', [PublicController::class, 'umkmDetail'])->name('public.umkm_detail');
Route::get('/artikel', [PublicController::class, 'artikel'])->name('artikel.index');
Route::get('/artikel/{id}', [PublicController::class, 'artikelDetail'])->name('artikel.detail');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/produk/{id}', [PublicController::class, 'produkDetail'])->name('produk.detail');
Route::get('/produk', [PublicController::class, 'produkIndex'])->name('produk.index');

// Rute-rute yang memerlukan autentikasi (untuk semua peran)
Route::middleware('auth')->group(function () {
    // Rute Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Dashboard Pengunjung (jika tidak ada peran khusus, ini adalah dashboard default setelah login)
    // Route::get('/dashboard', [PengunjungDashboardController::class, 'index'])->name('dashboard'); // This line is commented out as per the edit hint
});

//Route umkm
Route::prefix('u')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UmkmController::class, 'dashboard'])->name('umkm_dashboard');

    // Profil UMKM
    Route::get('/editprofile', [UmkmProfileController::class, 'edit'])->name('umkm_editprofile');
    Route::put('/profil/update', [UmkmProfileController::class, 'update'])->name('umkm_updateprofile');

    // Produk UMKM
    Route::get('/produk', [UmkmProductController::class, 'index'])->name('umkm_produk');
    Route::get('/produk/create', [UmkmProductController::class, 'create'])->name('umkm_produkcreate');
    Route::post('/produk/store', [UmkmProductController::class, 'store'])->name('umkm_produkstore');
    Route::get('/produk/{id}/edit', [UmkmProductController::class, 'edit'])->name('umkm_produkedit');
    Route::put('/produk/{id}', [UmkmProductController::class, 'update'])->name('umkm_produkupdate');
    Route::delete('/produk/{id}', [UmkmProductController::class, 'destroy'])->name('umkm_produkdestroy');
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
    Route::post('/admin/contact/{id}/mark-as-read', [AdminContactController::class, 'markAsRead'])->name('admin.contact.markAsRead');
    Route::resource('/admin/contact', AdminContactController::class, [ 'as' => 'admin' ]);
    Route::get('/produk/{id}/edit', [AdminProductController::class, 'edit'])->name('admin_produk.edit');
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
        return redirect()->route('umkm_dashboard');
    } else {
        // Asumsi peran selain admin/umkm adalah pengunjung
        return redirect()->route('dashboard'); // Arahkan ke dashboard pengunjung
    }
})->middleware(['auth']);

Route::get('/cek-auth', function () {
    return [
        'is_logged_in' => Auth::check(),
        'user_id' => Auth::id(),
        'user' => Auth::user(),
    ];
});

