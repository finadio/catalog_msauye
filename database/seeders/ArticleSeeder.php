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
     *
     * Metode ini akan mengisi tabel 'articles' dengan data dummy.
     * Konten artikel telah diperpanjang dan diperkaya informasinya.
     */
    public function run(): void
    {
        // Hapus data yang ada untuk menghindari duplikasi saat seeding berulang
        // Anda bisa mengomentari baris ini jika ingin menambahkan tanpa menghapus yang sudah ada,
        // namun berhati-hatilah dengan duplikasi judul.
        // Article::truncate(); // Gunakan ini jika ingin menghapus semua artikel sebelum menambahkan yang baru

        DB::table('articles')->insert([
            [
                'title' => 'Strategi Digital Marketing Efektif untuk UMKM',
                'content' => 'Dalam era digital yang terus berkembang pesat, strategi pemasaran online telah menjadi pilar utama bagi keberhasilan UMKM. Memahami dan mengimplementasikan teknik-teknik seperti Search Engine Optimization (SEO), pemasaran media sosial yang terarah, dan kampanye iklan digital yang cerdas dapat secara signifikan memperluas jangkauan produk atau layanan Anda, menjangkau audiens yang lebih luas dari sebelumnya. Artikel ini akan membahas langkah-langkah praktis dan tips mendalam untuk memulai perjalanan digital marketing Anda, mulai dari riset kata kunci, pembuatan konten yang menarik, hingga analisis performa kampanye. Dengan panduan ini, UMKM dapat bersaing lebih efektif di pasar yang semakin kompetitif.',
                'type' => 'edukasi',
                'photo' => null, // Bisa diganti dengan 'artikel/digital_marketing.jpg' jika ada dummy foto
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BPR MSA Berhasil Salurkan Kredit UMKM Terbesar Tahun Ini',
                'content' => 'Yogyakarta - PT BPR MSA dengan bangga mengumumkan pencapaian historis dalam penyaluran kredit untuk sektor Usaha Mikro, Kecil, dan Menengah (UMKM) di seluruh wilayah Daerah Istimewa Yogyakarta. Dalam laporan keuangan terbaru, BPR MSA berhasil menyalurkan total kredit sebesar Rp 150 miliar kepada lebih dari 2.500 pelaku UMKM sepanjang tahun ini, menjadikannya penyalur kredit UMKM terbesar di provinsi tersebut. Peningkatan signifikan ini tidak hanya mencerminkan kepercayaan UMKM terhadap BPR MSA, tetapi juga menegaskan komitmen kuat bank dalam mendukung pertumbuhan ekonomi lokal, menciptakan lapangan kerja, dan memberdayakan pelaku usaha kecil untuk naik kelas. Berbagai program pendampingan dan pelatihan juga turut menyertai fasilitas kredit ini, memastikan UMKM dapat mengelola usahanya dengan lebih profesional.',
                'type' => 'berita',
                'photo' => null, // Bisa diganti dengan 'artikel/kredit_umkm.jpg' jika ada dummy foto
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Pentingnya Pencatatan Keuangan Sederhana bagi UMKM',
                'content' => 'Salah satu tantangan terbesar yang sering dihadapi UMKM adalah pengelolaan keuangan yang kurang optimal. Banyak pelaku usaha mikro dan kecil cenderung mengabaikan pencatatan keuangan karena dianggap rumit, memakan waktu, atau tidak terlalu mendesak. Padahal, pencatatan keuangan yang rapi dan akurat adalah fondasi esensial untuk mengukur kesehatan finansial bisnis Anda, mengidentifikasi area yang perlu perbaikan, dan membuat keputusan strategis yang tepat di masa depan. Artikel ini akan memandu Anda melalui metode pencatatan keuangan sederhana yang mudah dipahami dan diterapkan, seperti pencatatan kas masuk dan keluar, inventaris, serta utang piutang. Dengan sistem pencatatan yang baik, UMKM dapat memantau arus kas, menghitung keuntungan, dan merencanakan pengembangan usaha dengan lebih terarah.',
                'type' => 'edukasi',
                'photo' => null, // Bisa diganti dengan 'artikel/keuangan_umkm.jpg' jika ada dummy foto
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'title' => 'Kolaborasi BPR MSA dengan Komunitas Pengrajin Lokal',
                'content' => 'Sebagai wujud dukungan nyata terhadap pelestarian budaya dan peningkatan ekonomi kreatif, BPR MSA dengan bangga menjalin kerja sama strategis dengan beberapa komunitas pengrajin batik, perak, dan gerabah di berbagai pelosok Yogyakarta. Inisiatif kolaborasi ini bertujuan untuk memberikan akses permodalan yang lebih mudah, pelatihan manajemen bisnis, serta pendampingan pemasaran bagi para pengrajin. Melalui program ini, diharapkan produk-produk kerajinan lokal yang kaya akan nilai seni dan budaya dapat lebih dikenal luas di pasar nasional maupun internasional, memiliki daya saing global, dan pada akhirnya meningkatkan kesejahteraan para pengrajin serta melestarikan warisan budaya Indonesia.',
                'type' => 'berita',
                'photo' => null, // Bisa diganti dengan 'artikel/kolaborasi_pengrajin.jpg' jika ada dummy foto
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'title' => 'Tips Memilih Platform E-commerce Terbaik untuk UMKM',
                'content' => 'Memasuki dunia penjualan online, salah satu keputusan krusial bagi UMKM adalah memilih platform e-commerce yang tepat. Pilihan platform yang sesuai dapat sangat memengaruhi efisiensi operasional, jangkauan pasar, dan biaya yang dikeluarkan. Artikel ini akan membandingkan beberapa platform e-commerce populer seperti Shopify, WooCommerce, Tokopedia, dan Shopee, menyoroti kelebihan dan kekurangannya masing-masing. Kami juga akan memberikan tips praktis dalam memilih platform yang paling sesuai dengan jenis produk Anda, skala bisnis, anggaran yang tersedia, serta fitur-fitur yang paling dibutuhkan untuk mengembangkan toko online Anda. Pertimbangkan faktor seperti kemudahan penggunaan, biaya langganan, fitur pembayaran, integrasi logistik, dan dukungan pelanggan.',
                'type' => 'edukasi',
                'photo' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'UMKM Makanan Lokal Berhasil Tembus Pasar Internasional Berkat Pembinaan BPR MSA',
                'content' => 'Inilah kisah inspiratif dari "Keripik Mantap", sebuah UMKM keripik tempe asal Bantul, Yogyakarta, yang berhasil menembus pasar internasional. Setelah bertahun-tahun berjuang di pasar lokal, pemilik Keripik Mantap, Ibu Siti, mendapatkan pendampingan intensif dari BPR MSA. Pendampingan ini meliputi pelatihan standardisasi produk, strategi branding, hingga akses ke jaringan ekspor. Berkat bimbingan BPR MSA, Keripik Mantap kini telah berhasil mengekspor produknya ke Malaysia, Singapura, dan Thailand, membuka peluang pasar yang lebih besar dan meningkatkan omzet secara signifikan. Kisah ini menjadi bukti nyata bahwa dengan dukungan yang tepat, UMKM lokal memiliki potensi besar untuk bersaing di kancah global.',
                'type' => 'berita',
                'photo' => null,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'title' => 'Memaksimalkan Penggunaan Media Sosial untuk Promosi Produk',
                'content' => 'Di era digital ini, media sosial bukan lagi sekadar platform untuk bersosialisasi, melainkan telah bertransformasi menjadi alat pemasaran yang sangat ampuh dan efektif, terutama bagi UMKM. Untuk memaksimalkan potensi ini, Anda perlu memahami lebih dari sekadar mengunggah foto produk. Artikel ini akan membahas strategi konten yang menarik perhatian, cara berinteraksi secara efektif dengan audiens untuk membangun loyalitas, serta pemanfaatan fitur-fitur media sosial seperti Instagram Stories, Reels, TikTok For Business, dan Facebook Ads untuk meningkatkan visibilitas dan penjualan produk UMKM Anda. Pelajari cara membuat jadwal posting, menganalisis metrik, dan beradaptasi dengan tren terbaru untuk mencapai hasil maksimal.',
                'type' => 'edukasi',
                'photo' => null,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'title' => 'Dukungan BPR MSA Terhadap Digitalisasi UMKM di Masa Pandemi',
                'content' => 'Pandemi COVID-19 memaksa banyak UMKM untuk beradaptasi dengan cepat dan beralih ke ranah digital. Dalam masa sulit ini, BPR MSA mengambil peran aktif dalam mendukung proses digitalisasi UMKM di Indonesia. BPR MSA meluncurkan berbagai inisiatif, termasuk program pelatihan gratis tentang pemasaran online, penggunaan platform e-commerce, dan manajemen keuangan digital. Selain itu, BPR MSA juga menyediakan fasilitas kredit khusus dengan bunga rendah yang dirancang untuk membantu UMKM mendapatkan modal yang dibutuhkan untuk investasi dalam infrastruktur digital, seperti pengembangan website, pembelian perangkat lunak, atau biaya iklan online. Dukungan ini bertujuan untuk memastikan UMKM tetap relevan dan mampu bertahan serta berkembang di tengah tantangan ekonomi.',
                'type' => 'berita',
                'photo' => null,
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
        ]);
    }
}
