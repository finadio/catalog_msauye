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
        ]);
    }
}