// database/migrations/YYYY_MM_DD_HHMMSS_add_status_to_users_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserStatusColumnToUsersTable extends Migration // INI YANG BENAR PASTIKAN NAMA KELAS INI SAMA DENGAN NAMA FILE ANDA
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'status' setelah 'email_verified_at'
            $table->string('status')->default('pending')->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'status' jika migrasi di-rollback
            $table->dropColumn('status');
        });
    }
};