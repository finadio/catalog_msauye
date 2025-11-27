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
        DB::table('product_statuses')->where('name', 'approved')->update(['name' => 'aktif']);
        DB::table('product_statuses')->where('name', 'rejected')->update(['name' => 'ditolak']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('product_statuses')->where('name', 'aktif')->update(['name' => 'approved']);
        DB::table('product_statuses')->where('name', 'ditolak')->update(['name' => 'rejected']);
    }
};
