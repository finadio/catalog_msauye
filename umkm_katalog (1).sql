-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 21, 2025 at 10:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umkm_katalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('edukasi','berita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `photo`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Strategi Digital Marketing Efektif untuk UMKM', 'Dalam era digital yang terus berkembang pesat, strategi pemasaran online telah menjadi pilar utama bagi keberhasilan UMKM. Memahami dan mengimplementasikan teknik-teknik seperti Search Engine Optimization (SEO), pemasaran media sosial yang terarah, dan kampanye iklan digital yang cerdas dapat secara signifikan memperluas jangkauan produk atau layanan Anda, menjangkau audiens yang lebih luas dari sebelumnya. Artikel ini akan membahas langkah-langkah praktis dan tips mendalam untuk memulai perjalanan digital marketing Anda, mulai dari riset kata kunci, pembuatan konten yang menarik, hingga analisis performa kampanye. Dengan panduan ini, UMKM dapat bersaing lebih efektif di pasar yang semakin kompetitif.', NULL, 'edukasi', '2025-07-20 20:14:50', '2025-07-20 20:14:50'),
(2, 'BPR MSA Berhasil Salurkan Kredit UMKM Terbesar Tahun Ini', 'Yogyakarta - PT BPR MSA dengan bangga mengumumkan pencapaian historis dalam penyaluran kredit untuk sektor Usaha Mikro, Kecil, dan Menengah (UMKM) di seluruh wilayah Daerah Istimewa Yogyakarta. Dalam laporan keuangan terbaru, BPR MSA berhasil menyalurkan total kredit sebesar Rp 150 miliar kepada lebih dari 2.500 pelaku UMKM sepanjang tahun ini, menjadikannya penyalur kredit UMKM terbesar di provinsi tersebut. Peningkatan signifikan ini tidak hanya mencerminkan kepercayaan UMKM terhadap BPR MSA, tetapi juga menegaskan komitmen kuat bank dalam mendukung pertumbuhan ekonomi lokal, menciptakan lapangan kerja, dan memberdayakan pelaku usaha kecil untuk naik kelas. Berbagai program pendampingan dan pelatihan juga turut menyertai fasilitas kredit ini, memastikan UMKM dapat mengelola usahanya dengan lebih profesional.', NULL, 'berita', '2025-07-15 20:14:50', '2025-07-15 20:14:50'),
(3, 'Pentingnya Pencatatan Keuangan Sederhana bagi UMKM', 'Salah satu tantangan terbesar yang sering dihadapi UMKM adalah pengelolaan keuangan yang kurang optimal. Banyak pelaku usaha mikro dan kecil cenderung mengabaikan pencatatan keuangan karena dianggap rumit, memakan waktu, atau tidak terlalu mendesak. Padahal, pencatatan keuangan yang rapi dan akurat adalah fondasi esensial untuk mengukur kesehatan finansial bisnis Anda, mengidentifikasi area yang perlu perbaikan, dan membuat keputusan strategis yang tepat di masa depan. Artikel ini akan memandu Anda melalui metode pencatatan keuangan sederhana yang mudah dipahami dan diterapkan, seperti pencatatan kas masuk dan keluar, inventaris, serta utang piutang. Dengan sistem pencatatan yang baik, UMKM dapat memantau arus kas, menghitung keuntungan, dan merencanakan pengembangan usaha dengan lebih terarah.', NULL, 'edukasi', '2025-07-10 20:14:50', '2025-07-10 20:14:50'),
(4, 'Kolaborasi BPR MSA dengan Komunitas Pengrajin Lokal', 'Sebagai wujud dukungan nyata terhadap pelestarian budaya dan peningkatan ekonomi kreatif, BPR MSA dengan bangga menjalin kerja sama strategis dengan beberapa komunitas pengrajin batik, perak, dan gerabah di berbagai pelosok Yogyakarta. Inisiatif kolaborasi ini bertujuan untuk memberikan akses permodalan yang lebih mudah, pelatihan manajemen bisnis, serta pendampingan pemasaran bagi para pengrajin. Melalui program ini, diharapkan produk-produk kerajinan lokal yang kaya akan nilai seni dan budaya dapat lebih dikenal luas di pasar nasional maupun internasional, memiliki daya saing global, dan pada akhirnya meningkatkan kesejahteraan para pengrajin serta melestarikan warisan budaya Indonesia.', NULL, 'berita', '2025-07-05 20:14:50', '2025-07-05 20:14:50'),
(5, 'Tips Memilih Platform E-commerce Terbaik untuk UMKM', 'Memasuki dunia penjualan online, salah satu keputusan krusial bagi UMKM adalah memilih platform e-commerce yang tepat. Pilihan platform yang sesuai dapat sangat memengaruhi efisiensi operasional, jangkauan pasar, dan biaya yang dikeluarkan. Artikel ini akan membandingkan beberapa platform e-commerce populer seperti Shopify, WooCommerce, Tokopedia, dan Shopee, menyoroti kelebihan dan kekurangannya masing-masing. Kami juga akan memberikan tips praktis dalam memilih platform yang paling sesuai dengan jenis produk Anda, skala bisnis, anggaran yang tersedia, serta fitur-fitur yang paling dibutuhkan untuk mengembangkan toko online Anda. Pertimbangkan faktor seperti kemudahan penggunaan, biaya langganan, fitur pembayaran, integrasi logistik, dan dukungan pelanggan.', NULL, 'edukasi', '2025-07-17 20:14:50', '2025-07-17 20:14:50'),
(6, 'UMKM Makanan Lokal Berhasil Tembus Pasar Internasional Berkat Pembinaan BPR MSA', 'Inilah kisah inspiratif dari \"Keripik Mantap\", sebuah UMKM keripik tempe asal Bantul, Yogyakarta, yang berhasil menembus pasar internasional. Setelah bertahun-tahun berjuang di pasar lokal, pemilik Keripik Mantap, Ibu Siti, mendapatkan pendampingan intensif dari BPR MSA. Pendampingan ini meliputi pelatihan standardisasi produk, strategi branding, hingga akses ke jaringan ekspor. Berkat bimbingan BPR MSA, Keripik Mantap kini telah berhasil mengekspor produknya ke Malaysia, Singapura, dan Thailand, membuka peluang pasar yang lebih besar dan meningkatkan omzet secara signifikan. Kisah ini menjadi bukti nyata bahwa dengan dukungan yang tepat, UMKM lokal memiliki potensi besar untuk bersaing di kancah global.', NULL, 'berita', '2025-07-13 20:14:50', '2025-07-13 20:14:50'),
(7, 'Memaksimalkan Penggunaan Media Sosial untuk Promosi Produk', 'Di era digital ini, media sosial bukan lagi sekadar platform untuk bersosialisasi, melainkan telah bertransformasi menjadi alat pemasaran yang sangat ampuh dan efektif, terutama bagi UMKM. Untuk memaksimalkan potensi ini, Anda perlu memahami lebih dari sekadar mengunggah foto produk. Artikel ini akan membahas strategi konten yang menarik perhatian, cara berinteraksi secara efektif dengan audiens untuk membangun loyalitas, serta pemanfaatan fitur-fitur media sosial seperti Instagram Stories, Reels, TikTok For Business, dan Facebook Ads untuk meningkatkan visibilitas dan penjualan produk UMKM Anda. Pelajari cara membuat jadwal posting, menganalisis metrik, dan beradaptasi dengan tren terbaru untuk mencapai hasil maksimal.', NULL, 'edukasi', '2025-06-30 20:14:50', '2025-06-30 20:14:50'),
(8, 'Dukungan BPR MSA Terhadap Digitalisasi UMKM di Masa Pandemi', 'Pandemi COVID-19 memaksa banyak UMKM untuk beradaptasi dengan cepat dan beralih ke ranah digital. Dalam masa sulit ini, BPR MSA mengambil peran aktif dalam mendukung proses digitalisasi UMKM di Indonesia. BPR MSA meluncurkan berbagai inisiatif, termasuk program pelatihan gratis tentang pemasaran online, penggunaan platform e-commerce, dan manajemen keuangan digital. Selain itu, BPR MSA juga menyediakan fasilitas kredit khusus dengan bunga rendah yang dirancang untuk membantu UMKM mendapatkan modal yang dibutuhkan untuk investasi dalam infrastruktur digital, seperti pengembangan website, pembelian perangkat lunak, atau biaya iklan online. Dukungan ini bertujuan untuk memastikan UMKM tetap relevan dan mampu bertahan serta berkembang di tengah tantangan ekonomi.', NULL, 'berita', '2025-06-28 20:14:50', '2025-06-28 20:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', NULL, NULL),
(2, 'Minuman', NULL, NULL),
(3, 'Kerajinan', NULL, NULL),
(4, 'Jasa', NULL, NULL),
(5, 'Fashion', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Fina Julianti', 'disnatinforunsoed@gmail.com', 'kerjasama_umkm', 'miaw', 1, '2025-07-21 00:37:46', '2025-07-21 00:59:56'),
(2, 'nana', 'nananininunu12@gmail.com', 'informasi_produk', 'hau', 0, '2025-07-21 01:00:23', '2025-07-21 01:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_16_045040_create_umkms_table', 1),
(5, '2025_07_16_045041_create_categories_table', 1),
(6, '2025_07_16_045042_create_articles_table', 1),
(7, '2025_07_16_045043_create_product_statuses_table', 1),
(8, '2025_07_16_045044_create_products_table', 1),
(9, '2025_07_16_045045_create_contacts_table', 1),
(10, '2025_07_18_013825_add_tiktok_website_to_umkms_table', 1),
(11, '2025_07_21_074038_add_is_read_to_contacts_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `umkm_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `umkm_id`, `category_id`, `name`, `description`, `price`, `photo`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Keripik Tempe Aneka Rasa', 'Keripik tempe renyah dengan bumbu spesial. Tersedia rasa original, pedas, dan balado. Cocok untuk cemilan keluarga.', '15000.00', 'produk-dummy-1.jpg', 2, '2025-07-20 20:14:51', '2025-07-20 20:14:51'),
(2, 1, 2, 'Kopi Robusta Khas Gunungkidul', 'Biji kopi robusta pilihan dari perkebunan lokal Gunungkidul. Aroma kuat dan rasa pahit yang khas, cocok untuk pecinta kopi sejati.', '45000.00', 'produk-dummy-2.jpg', 2, '2025-07-18 20:14:51', '2025-07-18 20:14:51'),
(3, 2, 3, 'Miniatur Becak Batik', 'Miniatur becak kayu dengan hiasan batik tulis, dibuat secara handmade oleh pengrajin lokal. Cocok untuk souvenir atau hiasan rumah.', '85000.00', 'produk-dummy-3.jpg', 2, '2025-07-15 20:14:51', '2025-07-15 20:14:51'),
(4, 1, 5, 'Kaos Batik Modern Pria', 'Kaos casual dengan motif batik modern, bahan katun combed 30s yang nyaman dan tidak panas. Tersedia berbagai ukuran.', '99000.00', 'produk-dummy-4.jpg', 2, '2025-07-13 20:14:51', '2025-07-13 20:14:51'),
(5, 2, 3, 'Topeng Kayu Ukir', 'Topeng kayu ukir tradisional khas Jawa, detail ukiran halus dan finishing premium. Cocok untuk koleksi atau dekorasi.', '120000.00', 'produk-dummy-5.jpg', 2, '2025-07-10 20:14:51', '2025-07-10 20:14:51'),
(6, 1, 1, 'Gudeg Kaleng Khas Jogja', 'Gudeg asli Jogja dalam kemasan kaleng, praktis dibawa dan awet. Rasa manis gurih yang otentik. Tersedia varian original dan pedas.', '35000.00', 'produk-dummy-6.jpg', 1, '2025-07-08 20:14:51', '2025-07-08 20:14:51'),
(7, 2, 2, 'Wedang Uwuh Instan', 'Minuman rempah tradisional Wedang Uwuh dalam bentuk instan. Hangat di badan, cocok untuk menjaga kesehatan. Tanpa pengawet.', '25000.00', 'produk-dummy-1.jpg', 2, '2025-07-05 20:14:51', '2025-07-05 20:14:51'),
(8, 1, 5, 'Batik Tulis Premium', 'Kain batik tulis asli, motif klasik elegan, pewarnaan alami. Cocok untuk acara formal maupun koleksi. Limited edition.', '500000.00', 'produk-dummy-2.jpg', 2, '2025-06-30 20:14:51', '2025-06-30 20:14:51'),
(9, 3, 1, 'Rendang Daging Sapi Premium', 'Rendang daging sapi khas Minang, dimasak dengan bumbu rempah pilihan, cita rasa otentik dan tahan lama.', '75000.00', 'produk-dummy-3.jpg', 2, '2025-07-19 20:14:51', '2025-07-19 20:14:51'),
(10, 3, 1, 'Pempek Palembang Asli', 'Pempek ikan tenggiri asli dengan cuko pedas manis, disajikan beku, siap goreng. Rasa dan tekstur otentik Palembang.', '40000.00', 'produk-dummy-4.jpg', 2, '2025-07-17 20:14:51', '2025-07-17 20:14:51'),
(11, 4, 5, 'Blouse Batik Modern Wanita', 'Blouse batik dengan desain modern, cocok untuk gaya kasual maupun formal. Bahan adem dan nyaman.', '150000.00', 'produk-dummy-5.jpg', 2, '2025-07-12 20:14:51', '2025-07-12 20:14:51'),
(12, 5, 4, 'Jasa Pembuatan Website Toko Online', 'Layanan pembuatan website toko online profesional, responsif, dan mudah dikelola. Bonus domain dan hosting 1 tahun.', '3500000.00', 'produk-dummy-6.jpg', 2, '2025-06-25 20:14:51', '2025-06-25 20:14:51'),
(13, 3, 2, 'Jamu Kunyit Asam Segar', 'Minuman jamu tradisional kunyit asam, dibuat dari bahan alami pilihan, tanpa pengawet. Menyegarkan dan menyehatkan.', '18000.00', 'produk-dummy-1.jpg', 2, '2025-07-14 20:14:51', '2025-07-14 20:14:51'),
(14, 4, 5, 'Kemeja Batik Pria Lengan Panjang', 'Kemeja batik formal dengan motif klasik, cocok untuk acara kantor atau pesta. Bahan katun primisima nyaman dipakai.', '180000.00', 'produk-dummy-2.jpg', 1, '2025-07-09 20:14:51', '2025-07-09 20:14:51'),
(15, 2, 3, 'Anyaman Bambu Hias Dinding', 'Hiasan dinding anyaman bambu artistik, cocok untuk dekorasi interior bergaya etnik modern.', '60000.00', 'produk-dummy-3.jpg', 2, '2025-07-06 20:14:51', '2025-07-06 20:14:51'),
(16, 5, 4, 'Jasa Desain Logo UMKM', 'Buat logo profesional dan menarik untuk usaha Anda. Desain unik dan representatif sesuai branding bisnis.', '750000.00', 'produk-dummy-4.jpg', 2, '2025-07-02 20:14:51', '2025-07-02 20:14:51'),
(17, 1, 1, 'Dodol Garut Asli', 'Dodol khas Garut dengan tekstur lembut dan rasa manis legit. Terbuat dari bahan-bahan alami pilihan.', '20000.00', 'produk-dummy-5.jpg', 2, '2025-07-11 20:14:51', '2025-07-11 20:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_statuses`
--

CREATE TABLE `product_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_statuses`
--

INSERT INTO `product_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pending', NULL, NULL),
(2, 'approved', NULL, NULL),
(3, 'rejected', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('i4ySZOF9aLtcwMCvMKeto1myNmRe0rgcTBUhyn2Z', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVGxVNDhiYzZVa2doQ0ZCd1JUWnNyY3I2bzhZR05BYjhIcVVJQlJRbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1753088689);

-- --------------------------------------------------------

--
-- Table structure for table `umkms`
--

CREATE TABLE `umkms` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umkms`
--

INSERT INTO `umkms` (`id`, `user_id`, `name`, `description`, `address`, `phone`, `whatsapp`, `instagram`, `tiktok`, `website`, `photo`, `created_at`, `updated_at`) VALUES
(1, 2, 'Toko UMKM Test', 'Menyediakan produk kerajinan tangan lokal.', 'Jl. Contoh UMKM No. 1, Yogyakarta', '08123456789', '628123456789', 'umkm_test_id', NULL, NULL, NULL, '2025-07-20 20:14:50', '2025-07-20 20:14:50'),
(2, 3, 'Kerajinan Jaya', 'Menyediakan aneka kerajinan tangan khas lokal.', 'Jl. Seni No. 10, Yogyakarta', '087811223344', '6287811223344', 'kerajinan_jaya', 'kerajinanjaya', 'https://kerajinanjaya.com', NULL, '2025-07-20 20:14:51', '2025-07-20 20:14:51'),
(3, 4, 'Kuliner Nusantara', 'Menyediakan masakan tradisional Indonesia.', 'Jl. Rasa No. 5, Jakarta', '081122334455', '6281122334455', 'kuliner_nusantara_id', 'kuliner_nusantara', 'https://kuliner-nusantara.com', NULL, '2025-07-20 20:14:51', '2025-07-20 20:14:51'),
(4, 5, 'Batik Indah Ceria', 'Pakaian batik modern dan tradisional berkualitas tinggi.', 'Jl. Mode No. 8, Solo', '089988776655', '6289988776655', 'batik_indah_ceria', NULL, NULL, NULL, '2025-07-20 20:14:51', '2025-07-20 20:14:51'),
(5, 6, 'Digital Solusi Kreasi', 'Jasa pembuatan website dan desain grafis untuk UMKM.', 'Jl. Kreatif No. 12, Bandung', '081211223344', '6281211223344', 'digitalsolusi_kreasi', NULL, 'https://digitalsolusi.com', NULL, '2025-07-20 20:14:51', '2025-07-20 20:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umkm',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin MSA', 'admin@msa.com', NULL, '$2y$12$/00qv12kO1nxfSiY0Zo72ub7bJvicytlCDHPGGqbvp/ksWiKjsDcW', 'i1gwGx3lh3Y6QD8zx4TXCYjcSoZziuARH41ybLVpGB0d3is2WSZSZr8YMAHM', 'admin', '2025-07-20 20:14:50', '2025-07-20 20:14:50'),
(2, 'Seller UMKM Test', 'umkm@example.com', '2025-07-20 20:14:50', '$2y$12$yjkQMwnZyxghUh2lFD9pPuInHLuNQP8TSSJE4B8fXlBzWrGaOlj0O', NULL, 'umkm', '2025-07-20 20:14:50', '2025-07-20 20:14:50'),
(3, 'Seller Kerajinan Jaya', 'umkm2@example.com', '2025-07-20 20:14:51', '$2y$12$4hB096kuJUGbFeKETM/XmO9w..9YT.fIF0VScBPZ/j3eJeWqltB7S', NULL, 'umkm', '2025-07-20 20:14:51', '2025-07-20 20:14:51'),
(4, 'Seller Kuliner Nusantara', 'umkm3@example.com', '2025-07-20 20:14:51', '$2y$12$JP24ge4eolbNRIFEGC0JNucb05E4T96ybk0HJOT4q29j9VLjW9ywO', NULL, 'umkm', '2025-07-20 20:14:51', '2025-07-20 20:14:51'),
(5, 'Seller Batik Indah', 'umkm4@example.com', '2025-07-20 20:14:51', '$2y$12$Fe4zgehhiAMkxao36MkPvOI54c78qaKUjMeVEopqBZyZN6jhRzBAi', NULL, 'umkm', '2025-07-20 20:14:51', '2025-07-20 20:14:51'),
(6, 'Seller Digital Solusi', 'umkm5@example.com', '2025-07-20 20:14:51', '$2y$12$KIV6G1dFd.Ecp6KCMHdtZuhLVUPfQP8iHtP45iCqZAbOMaWIm1DqC', NULL, 'umkm', '2025-07-20 20:14:51', '2025-07-20 20:14:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_umkm_id_foreign` (`umkm_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_status_id_foreign` (`status_id`);

--
-- Indexes for table `product_statuses`
--
ALTER TABLE `product_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `umkms`
--
ALTER TABLE `umkms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umkms_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_statuses`
--
ALTER TABLE `product_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `umkms`
--
ALTER TABLE `umkms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `product_statuses` (`id`),
  ADD CONSTRAINT `products_umkm_id_foreign` FOREIGN KEY (`umkm_id`) REFERENCES `umkms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `umkms`
--
ALTER TABLE `umkms`
  ADD CONSTRAINT `umkms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
