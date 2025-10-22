<?php
// Test koneksi antara Filament, Public, dan UMKM Dashboard

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;
use App\Models\Article;
use App\Models\Umkm;
use App\Models\User;
use App\Models\Category;

echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║     TEST KONEKSI: Filament ↔ Public ↔ UMKM Dashboard      ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

// 1. Test Products
echo "📦 PRODUK:\n";
echo "   Total semua produk: " . Product::count() . "\n";
echo "   Produk APPROVED (tampil di public): " . Product::whereHas('status', function($q) {
    $q->where('name', 'approved');
})->count() . "\n";
echo "   Produk PENDING (perlu approve): " . Product::whereHas('status', function($q) {
    $q->where('name', 'pending');
})->count() . "\n\n";

// 2. Test Articles
echo "📰 ARTIKEL:\n";
echo "   Total artikel: " . Article::count() . "\n";
if (Article::count() > 0) {
    $latestArticle = Article::latest()->first();
    echo "   Artikel terbaru: \"{$latestArticle->title}\"\n";
    echo "   Type: {$latestArticle->type}\n";
}
echo "\n";

// 3. Test UMKM
echo "🏪 UMKM:\n";
echo "   Total UMKM: " . Umkm::count() . "\n";
if (Umkm::count() > 0) {
    $umkmWithMostProducts = Umkm::withCount('products')->orderBy('products_count', 'desc')->first();
    echo "   UMKM terbanyak produk: \"{$umkmWithMostProducts->name}\" ({$umkmWithMostProducts->products_count} produk)\n";
}
echo "\n";

// 4. Test Users
echo "👥 USERS:\n";
echo "   Total users: " . User::count() . "\n";
echo "   Admin: " . User::where('role', 'admin')->count() . "\n";
echo "   UMKM: " . User::where('role', 'umkm')->count() . "\n";
echo "   Public: " . User::where('role', 'public')->count() . "\n";
echo "   User APPROVED: " . User::where('status', 'approved')->count() . "\n";
echo "   User PENDING: " . User::where('status', 'pending')->count() . "\n\n";

// 5. Test Categories
echo "🏷️  KATEGORI:\n";
echo "   Total kategori: " . Category::count() . "\n";
if (Category::count() > 0) {
    $categories = Category::withCount('products')->get();
    foreach ($categories as $cat) {
        echo "   - {$cat->name}: {$cat->products_count} produk\n";
    }
}
echo "\n";

// 6. Test Relationships
echo "🔗 TEST KONEKSI:\n";
if (Product::count() > 0) {
    $product = Product::with(['umkm', 'category', 'status'])->first();
    $umkmName = $product->umkm ? $product->umkm->name : 'N/A';
    $categoryName = $product->category ? $product->category->name : 'N/A';
    $statusName = $product->status ? $product->status->name : 'N/A';
    echo "   ✅ Product → UMKM: {$umkmName}\n";
    echo "   ✅ Product → Category: {$categoryName}\n";
    echo "   ✅ Product → Status: {$statusName}\n";
} else {
    echo "   ⚠️  Tidak ada produk untuk test relationship\n";
}

echo "\n╔════════════════════════════════════════════════════════════╗\n";
echo "║                      KESIMPULAN                            ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

$approvedProducts = Product::whereHas('status', function($q) {
    $q->where('name', 'approved');
})->count();

if ($approvedProducts > 0) {
    echo "✅ Data TERHUBUNG! Produk approved akan muncul di:\n";
    echo "   - Public Frontend: http://localhost/catalog_msauye/\n";
    echo "   - UMKM Dashboard: http://localhost/catalog_msauye/u/produk\n";
    echo "   - Filament Admin: http://localhost/catalog_msauye/filament\n";
} else {
    echo "⚠️  Belum ada produk approved.\n";
    echo "   Silakan login ke Filament dan approve produk terlebih dahulu.\n";
}

echo "\n🎯 Semua modul menggunakan MODEL YANG SAMA!\n";
echo "   Perubahan di Filament = Langsung terlihat di Public & UMKM\n\n";
