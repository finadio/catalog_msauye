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
        Schema::table('umkms', function (Blueprint $table) {
            $table->string('tiktok')->nullable()->after('instagram'); // Tambahkan kolom tiktok setelah instagram
            $table->string('website')->nullable()->after('tiktok'); // Tambahkan kolom website setelah tiktok
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn('tiktok');
            $table->dropColumn('website');
        });
    }
};