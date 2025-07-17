<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use App\Models\Umkm; // Import model Umkm

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user UMKM jika belum ada (atau dapatkan yang sudah ada)
        $umkmUser = User::firstOrCreate(
            ['email' => 'umkm@example.com'], // Kriteria pencarian
            [
                'name' => 'Seller UMKM Test',
                'password' => bcrypt('password'), // Password standar
                'role' => 'umkm',
                'email_verified_at' => now(), // Opsional: Verifikasi email otomatis
            ]
        );

        // Buat entri UMKM untuk user ini jika belum ada
        if (!$umkmUser->umkm) { // Periksa apakah user ini sudah punya relasi umkm
            Umkm::create([
                'user_id' => $umkmUser->id,
                'name' => 'Toko UMKM Test',
                'description' => 'Menyediakan produk kerajinan tangan lokal.',
                'address' => 'Jl. Contoh UMKM No. 1, Yogyakarta',
                'phone' => '08123456789',
                'whatsapp' => '628123456789',
                'instagram' => 'umkm_test_id',
                // 'photo' => 'path/to/umkm_photo.jpg', // Opsional, jika ada dummy photo
            ]);
        }

        // Contoh lain: Buat beberapa UMKM dummy
        // \App\Models\Umkm::factory(5)->create(); // Ini butuh UmkmFactory
    }
}