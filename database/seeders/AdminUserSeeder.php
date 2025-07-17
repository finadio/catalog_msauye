<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah admin dengan email ini sudah ada
        $exists = DB::table('users')->where('email', 'admin@msa.com')->exists();

        if (!$exists) {
            DB::table('users')->insert([
                'name' => 'Admin MSA',
                'email' => 'admin@msa.com',
                'password' => Hash::make('password'), // ganti sesuai kebutuhan
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

