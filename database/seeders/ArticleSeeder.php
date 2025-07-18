<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Article; // Pastikan model Article di-import

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'title' => 'Strategi Digital Marketing Efektif untuk UMKM',
                'content' => 'Dalam era digital saat ini, strategi pemasaran online menjadi kunci keberhasilan UMKM. Memahami SEO, media sosial, dan iklan digital dapat meningkatkan jangkauan produk Anda secara signifikan. Artikel ini membahas langkah-langkah praktis untuk memulai.',
                'type' => 'edukasi',
                'photo' => null, // Bisa diganti dengan 'artikel/digital_marketing.jpg' jika ada dummy foto
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BPR MSA Berhasil Salurkan Kredit UMKM Terbesar Tahun Ini',
                'content' => 'Yogyakarta - PT BPR MSA mengumumkan pencapaian rekor penyaluran kredit untuk sektor UMKM di wilayah Yogyakarta. Peningkatan ini menunjukkan komitmen BPR MSA dalam mendukung pertumbuhan ekonomi lokal dan memberdayakan pelaku usaha mikro kecil dan menengah.',
                'type' => 'berita',
                'photo' => null, // Bisa diganti dengan 'artikel/kredit_umkm.jpg' jika ada dummy foto
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Pentingnya Pencatatan Keuangan Sederhana bagi UMKM',
                'content' => 'Banyak UMKM mengabaikan pencatatan keuangan karena dianggap rumit. Padahal, pencatatan yang baik adalah fondasi untuk mengukur kesehatan bisnis dan membuat keputusan yang tepat. Pelajari cara mudah mencatat keuangan usaha Anda.',
                'type' => 'edukasi',
                'photo' => null, // Bisa diganti dengan 'artikel/keuangan_umkm.jpg' jika ada dummy foto
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'title' => 'Kolaborasi BPR MSA dengan Komunitas Pengrajin Lokal',
                'content' => 'Sebagai wujud dukungan nyata, BPR MSA menjalin kerja sama strategis dengan beberapa komunitas pengrajin di Yogyakarta. Melalui inisiatif ini, diharapkan produk-produk kerajinan lokal dapat lebih dikenal luas dan memiliki daya saing global.',
                'type' => 'berita',
                'photo' => null, // Bisa diganti dengan 'artikel/kolaborasi_pengrajin.jpg' jika ada dummy foto
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            // New dummy articles
            [
                'title' => 'Tips Memilih Platform E-commerce Terbaik untuk UMKM',
                'content' => 'Memilih platform e-commerce yang tepat adalah langkah krusial. Artikel ini membandingkan beberapa platform populer dan memberikan tips memilih yang sesuai dengan kebutuhan dan anggaran UMKM Anda.',
                'type' => 'edukasi',
                'photo' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'UMKM Makanan Lokal Berhasil Tembus Pasar Internasional Berkat Pembinaan BPR MSA',
                'content' => 'Kisah sukses UMKM keripik tempe dari Yogyakarta yang berhasil mengekspor produknya ke beberapa negara Asia Tenggara setelah mendapat pendampingan intensif dari BPR MSA dalam aspek manajemen dan pemasaran.',
                'type' => 'berita',
                'photo' => null,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'title' => 'Memaksimalkan Penggunaan Media Sosial untuk Promosi Produk',
                'content' => 'Media sosial bukan hanya untuk bersosialisasi, tetapi juga alat pemasaran yang ampuh. Pelajari strategi konten, interaksi dengan audiens, dan penggunaan fitur-fitur media sosial untuk meningkatkan penjualan UMKM Anda.',
                'type' => 'edukasi',
                'photo' => null,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'title' => 'Dukungan BPR MSA Terhadap Digitalisasi UMKM di Masa Pandemi',
                'content' => 'Bagaimana BPR MSA beradaptasi dan memberikan dukungan kepada UMKM untuk beralih ke platform digital selama pandemi, termasuk pelatihan gratis dan fasilitas kredit khusus untuk modal digitalisasi.',
                'type' => 'berita',
                'photo' => null,
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
        ]);
    }
}