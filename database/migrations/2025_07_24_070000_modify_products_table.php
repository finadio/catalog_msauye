<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // LANGKAH 1: Hapus foreign key constraint 'products_user_id_foreign' terlebih dahulu
            $table->dropForeign(['user_id']);

            // LANGKAH 2: Hapus kolom user_id
            $table->dropColumn('user_id');

            // LANGKAH 3: Hapus kolom-kolom lain yang tidak diperlukan
            // Pastikan kolom-kolom ini memang ada di tabel Anda sebelum dihapus
            $table->dropColumn([
                'category',
                'location',
                'show_price',
                'whatsapp',
                'instagram',
                'tiktok_shop',
                'website',
                'telepon',
                'status' // Kolom 'status' ini adalah enum dari create_products_table
            ]);

            // LANGKAH 4: Tambah kolom umkm_id dan foreign key baru ke tabel 'umkms'
            // Sesuaikan posisi 'after' jika diperlukan
            $table->foreignId('umkm_id')->after('id')->constrained('umkms')->onDelete('cascade');

            // LANGKAH 5: Tambah foreign key untuk category_id dan status_id
            // category_id dan status_id menggantikan kolom 'category' dan 'status' yang dihapus
            $table->foreignId('category_id')->after('description')->constrained()->onDelete('cascade');
            $table->foreignId('status_id')->after('category_id')->constrained('product_statuses')->onDelete('cascade');

            // Hapus baris ini:
            // $table->string('photo')->nullable()->after('status_id');
            // Kolom 'images' sudah ada dari migrasi create_products_table dan akan tetap digunakan.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Di metode down, Anda harus mengembalikan perubahan yang dilakukan di up
            // Pertama, hapus foreign keys yang baru ditambahkan
            $table->dropForeign(['umkm_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['status_id']);

            // Hapus kolom-kolom baru
            $table->dropColumn(['umkm_id', 'category_id', 'status_id']); // Hapus juga 'photo' jika sebelumnya ditambahkan

            // Tambahkan kembali kolom user_id dengan foreign key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Tambahkan kembali kolom-kolom lain yang dihapus
            // Pastikan tipe data dan nullable sesuai definisi asli di create_products_table
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->boolean('show_price')->default(true);
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok_shop')->nullable();
            $table->string('website')->nullable();
            $table->string('telepon')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        });
    }
};