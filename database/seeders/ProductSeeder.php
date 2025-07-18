<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStatus;
use App\Models\Umkm;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryMakanan = Category::where('name', 'Makanan')->first();
        $categoryMinuman = Category::where('name', 'Minuman')->first();
        $categoryKerajinan = Category::where('name', 'Kerajinan')->first();
        $categoryFashion = Category::where('name', 'Fashion')->first();

        $statusApproved = ProductStatus::where('name', 'approved')->first();
        $statusPending = ProductStatus::where('name', 'pending')->first();

        $umkmTest = Umkm::where('name', 'Toko UMKM Test')->first();
        // Anda bisa menambahkan UMKM dummy lain di UmkmSeeder jika ingin lebih banyak variasi produk
        $umkm2 = Umkm::create([
            'user_id' => \App\Models\User::factory()->create(['role' => 'umkm'])->id,
            'name' => 'Kerajinan Jaya',
            'description' => 'Menyediakan aneka kerajinan tangan khas lokal.',
            'address' => 'Jl. Seni No. 10, Yogyakarta',
            'phone' => '087811223344',
            'whatsapp' => '6287811223344',
            'instagram' => 'kerajinan_jaya',
            'tiktok' => 'kerajinanjaya',
            'website' => 'https://kerajinanjaya.com',
            'photo' => null,
        ]);


        DB::table('products')->insert([
            [
                'umkm_id' => $umkmTest->id,
                'category_id' => $categoryMakanan->id,
                'name' => 'Keripik Tempe Aneka Rasa',
                'description' => 'Keripik tempe renyah dengan bumbu spesial. Tersedia rasa original, pedas, dan balado. Cocok untuk cemilan keluarga.',
                'price' => 15000.00,
                'photo' => 'produk-dummy-1.jpg', // Gambar dummy
                'status_id' => $statusApproved->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'umkm_id' => $umkmTest->id,
                'category_id' => $categoryMinuman->id,
                'name' => 'Kopi Robusta Khas Gunungkidul',
                'description' => 'Biji kopi robusta pilihan dari perkebunan lokal Gunungkidul. Aroma kuat dan rasa pahit yang khas, cocok untuk pecinta kopi sejati.',
                'price' => 45000.00,
                'photo' => 'produk-dummy-2.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'umkm_id' => $umkm2->id,
                'category_id' => $categoryKerajinan->id,
                'name' => 'Miniatur Becak Batik',
                'description' => 'Miniatur becak kayu dengan hiasan batik tulis, dibuat secara handmade oleh pengrajin lokal. Cocok untuk souvenir atau hiasan rumah.',
                'price' => 85000.00,
                'photo' => 'produk-dummy-3.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'umkm_id' => $umkmTest->id,
                'category_id' => $categoryFashion->id,
                'name' => 'Kaos Batik Modern Pria',
                'description' => 'Kaos casual dengan motif batik modern, bahan katun combed 30s yang nyaman dan tidak panas. Tersedia berbagai ukuran.',
                'price' => 99000.00,
                'photo' => 'produk-dummy-4.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'umkm_id' => $umkm2->id,
                'category_id' => $categoryKerajinan->id,
                'name' => 'Topeng Kayu Ukir',
                'description' => 'Topeng kayu ukir tradisional khas Jawa, detail ukiran halus dan finishing premium. Cocok untuk koleksi atau dekorasi.',
                'price' => 120000.00,
                'photo' => 'produk-dummy-5.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'umkm_id' => $umkmTest->id,
                'category_id' => $categoryMakanan->id,
                'name' => 'Gudeg Kaleng Khas Jogja',
                'description' => 'Gudeg asli Jogja dalam kemasan kaleng, praktis dibawa dan awet. Rasa manis gurih yang otentik. Tersedia varian original dan pedas.',
                'price' => 35000.00,
                'photo' => 'produk-dummy-6.jpg',
                'status_id' => $statusPending->id, // Contoh produk dengan status pending
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'umkm_id' => $umkm2->id,
                'category_id' => $categoryMinuman->id,
                'name' => 'Wedang Uwuh Instan',
                'description' => 'Minuman rempah tradisional Wedang Uwuh dalam bentuk instan. Hangat di badan, cocok untuk menjaga kesehatan. Tanpa pengawet.',
                'price' => 25000.00,
                'photo' => 'produk-dummy-1.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'umkm_id' => $umkmTest->id,
                'category_id' => $categoryFashion->id,
                'name' => 'Batik Tulis Premium',
                'description' => 'Kain batik tulis asli, motif klasik elegan, pewarnaan alami. Cocok untuk acara formal maupun koleksi. Limited edition.',
                'price' => 500000.00,
                'photo' => 'produk-dummy-2.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
        ]);
    }
}