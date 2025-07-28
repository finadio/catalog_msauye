<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Metode up() ini dikosongkan karena kolom umkm_id tidak seharusnya ada di tabel users
     * untuk relasi User hasOne Umkm yang benar.
     */
    public function up(): void
    {
        // Kode di sini sebelumnya mencoba menghapus foreign key/kolom.
        // Sekarang, metode ini tidak akan melakukan apa-apa saat dijalankan,
        // yang sesuai dengan tujuan agar kolom umkm_id tidak ada di tabel users.
    }

    /**
     * Reverse the migrations.
     * Metode down() tetap seperti semula agar bisa mengembalikan kolom jika diperlukan
     * oleh perintah rollback yang sangat spesifik untuk migrasi ini saja.
     * Namun, untuk solusi utama, kita akan menggunakan migrate:fresh.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('umkm_id')->nullable()->after('id')->constrained();
        });
    }
};