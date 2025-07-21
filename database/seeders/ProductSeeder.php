<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStatus;
use App\Models\Umkm;
use App\Models\User; // Tambahkan ini untuk model User

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
        $categoryJasa = Category::where('name', 'Jasa')->first(); // Assuming 'Jasa' category exists

        $statusApproved = ProductStatus::where('name', 'approved')->first();
        $statusPending = ProductStatus::where('name', 'pending')->first();
        $statusRejected = ProductStatus::where('name', 'rejected')->first();

        // Pastikan semua UMKM yang dibutuhkan sudah ada atau dibuat terlebih dahulu
        $umkmTest = Umkm::firstOrCreate(
            ['name' => 'Toko UMKM Test'],
            [
                'user_id' => User::firstOrCreate(['email' => 'umkm@example.com'], ['name' => 'Seller UMKM Test', 'password' => bcrypt('password'), 'role' => 'umkm', 'email_verified_at' => now()])->id,
                'description' => 'Menyediakan produk kerajinan tangan lokal.',
                'address' => 'Jl. Contoh UMKM No. 1, Yogyakarta',
                'phone' => '08123456789',
                'whatsapp' => '628123456789',
                'instagram' => 'umkm_test_id',
                'tiktok' => null,
                'website' => null,
            ]
        );

        $umkmKerajinanJaya = Umkm::firstOrCreate(
            ['name' => 'Kerajinan Jaya'],
            [
                'user_id' => User::firstOrCreate(['email' => 'umkm2@example.com'], ['name' => 'Seller Kerajinan Jaya', 'password' => bcrypt('password'), 'role' => 'umkm', 'email_verified_at' => now()])->id,
                'description' => 'Menyediakan aneka kerajinan tangan khas lokal.',
                'address' => 'Jl. Seni No. 10, Yogyakarta',
                'phone' => '087811223344',
                'whatsapp' => '6287811223344',
                'instagram' => 'kerajinan_jaya',
                'tiktok' => 'kerajinanjaya',
                'website' => 'https://kerajinanjaya.com',
            ]
        );

        $umkmKulinerNusantara = Umkm::firstOrCreate(
            ['name' => 'Kuliner Nusantara'],
            [
                'user_id' => User::firstOrCreate(['email' => 'umkm3@example.com'], ['name' => 'Seller Kuliner Nusantara', 'password' => bcrypt('password'), 'role' => 'umkm', 'email_verified_at' => now()])->id,
                'description' => 'Menyediakan masakan tradisional Indonesia.',
                'address' => 'Jl. Rasa No. 5, Jakarta',
                'phone' => '081122334455',
                'whatsapp' => '6281122334455',
                'instagram' => 'kuliner_nusantara_id',
                'tiktok' => 'kuliner_nusantara',
                'website' => 'https://kuliner-nusantara.com',
            ]
        );

        $umkmBatikIndah = Umkm::firstOrCreate(
            ['name' => 'Batik Indah Ceria'],
            [
                'user_id' => User::firstOrCreate(['email' => 'umkm4@example.com'], ['name' => 'Seller Batik Indah', 'password' => bcrypt('password'), 'role' => 'umkm', 'email_verified_at' => now()])->id,
                'description' => 'Pakaian batik modern dan tradisional berkualitas tinggi.',
                'address' => 'Jl. Mode No. 8, Solo',
                'phone' => '089988776655',
                'whatsapp' => '6289988776655',
                'instagram' => 'batik_indah_ceria',
                'tiktok' => null,
                'website' => null,
            ]
        );

        $umkmDigitalSolusi = Umkm::firstOrCreate(
            ['name' => 'Digital Solusi Kreasi'],
            [
                'user_id' => User::firstOrCreate(['email' => 'umkm5@example.com'], ['name' => 'Seller Digital Solusi', 'password' => bcrypt('password'), 'role' => 'umkm', 'email_verified_at' => now()])->id,
                'description' => 'Jasa pembuatan website dan desain grafis untuk UMKM.',
                'address' => 'Jl. Kreatif No. 12, Bandung',
                'phone' => '081211223344',
                'whatsapp' => '6281211223344',
                'instagram' => 'digitalsolusi_kreasi',
                'tiktok' => null,
                'website' => 'https://digitalsolusi.com',
            ]
        );


        DB::table('products')->insert([
            [
                'umkm_id' => $umkmTest->id,
                'category_id' => $categoryMakanan->id,
                'name' => 'Keripik Tempe Aneka Rasa',
                'description' => 'Keripik tempe renyah dengan bumbu spesial. Tersedia rasa original, pedas, dan balado. Cocok untuk cemilan keluarga.',
                'price' => 15000.00,
                'photo' => 'produk-dummy-1.jpg',
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
                'umkm_id' => $umkmKerajinanJaya->id,
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
                'umkm_id' => $umkmKerajinanJaya->id,
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
                'status_id' => $statusPending->id,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'umkm_id' => $umkmKerajinanJaya->id,
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
            // New dummy products
            [
                'umkm_id' => $umkmKulinerNusantara->id,
                'category_id' => $categoryMakanan->id,
                'name' => 'Rendang Daging Sapi Premium',
                'description' => 'Rendang daging sapi khas Minang, dimasak dengan bumbu rempah pilihan, cita rasa otentik dan tahan lama.',
                'price' => 75000.00,
                'photo' => 'produk-dummy-3.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'umkm_id' => $umkmKulinerNusantara->id,
                'category_id' => $categoryMakanan->id,
                'name' => 'Pempek Palembang Asli',
                'description' => 'Pempek ikan tenggiri asli dengan cuko pedas manis, disajikan beku, siap goreng. Rasa dan tekstur otentik Palembang.',
                'price' => 40000.00,
                'photo' => 'produk-dummy-4.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'umkm_id' => $umkmBatikIndah->id,
                'category_id' => $categoryFashion->id,
                'name' => 'Blouse Batik Modern Wanita',
                'description' => 'Blouse batik dengan desain modern, cocok untuk gaya kasual maupun formal. Bahan adem dan nyaman.',
                'price' => 150000.00,
                'photo' => 'produk-dummy-5.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'umkm_id' => $umkmDigitalSolusi->id,
                'category_id' => $categoryJasa->id,
                'name' => 'Jasa Pembuatan Website Toko Online',
                'description' => 'Layanan pembuatan website toko online profesional, responsif, dan mudah dikelola. Bonus domain dan hosting 1 tahun.',
                'price' => 3500000.00,
                'photo' => 'produk-dummy-6.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],
            [
                'umkm_id' => $umkmKulinerNusantara->id,
                'category_id' => $categoryMinuman->id,
                'name' => 'Jamu Kunyit Asam Segar',
                'description' => 'Minuman jamu tradisional kunyit asam, dibuat dari bahan alami pilihan, tanpa pengawet. Menyegarkan dan menyehatkan.',
                'price' => 18000.00,
                'photo' => 'produk-dummy-1.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'umkm_id' => $umkmBatikIndah->id,
                'category_id' => $categoryFashion->id,
                'name' => 'Kemeja Batik Pria Lengan Panjang',
                'description' => 'Kemeja batik formal dengan motif klasik, cocok untuk acara kantor atau pesta. Bahan katun primisima nyaman dipakai.',
                'price' => 180000.00,
                'photo' => 'produk-dummy-2.jpg',
                'status_id' => $statusPending->id,
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(11),
            ],
            [
                'umkm_id' => $umkmKerajinanJaya->id,
                'category_id' => $categoryKerajinan->id,
                'name' => 'Anyaman Bambu Hias Dinding',
                'description' => 'Hiasan dinding anyaman bambu artistik, cocok untuk dekorasi interior bergaya etnik modern.',
                'price' => 60000.00,
                'photo' => 'produk-dummy-3.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'umkm_id' => $umkmDigitalSolusi->id,
                'category_id' => $categoryJasa->id,
                'name' => 'Jasa Desain Logo UMKM',
                'description' => 'Buat logo profesional dan menarik untuk usaha Anda. Desain unik dan representatif sesuai branding bisnis.',
                'price' => 750000.00,
                'photo' => 'produk-dummy-4.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
            [
                'umkm_id' => $umkmTest->id,
                'category_id' => $categoryMakanan->id,
                'name' => 'Dodol Garut Asli',
                'description' => 'Dodol khas Garut dengan tekstur lembut dan rasa manis legit. Terbuat dari bahan-bahan alami pilihan.',
                'price' => 20000.00,
                'photo' => 'produk-dummy-5.jpg',
                'status_id' => $statusApproved->id,
                'created_at' => now()->subDays(9),
                'updated_at' => now()->subDays(9),
            ],
        ]);
    }
}