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
                    'photo' => 'umkm-default.png', // Foto dummy
            ]);
        }

        // Contoh lain: Buat beberapa UMKM dummy
        // \App\Models\Umkm::factory(5)->create(); // Ini butuh UmkmFactory

            // Tambahan data dummy UMKM
            $dummyUmkm = [
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'UMKM Batik Ceria',
                    'description' => 'Menjual batik modern dan tradisional.',
                    'address' => 'Jl. Batik No. 2, Solo',
                    'phone' => '08123456780',
                    'whatsapp' => '628123456780',
                    'instagram' => 'batikceria',
                    'photo' => 'umkm-default1.png',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'UMKM Kerajinan Kayu',
                    'description' => 'Kerajinan kayu handmade untuk dekorasi.',
                    'address' => 'Jl. Kayu No. 3, Magelang',
                    'phone' => '08123456781',
                    'whatsapp' => '628123456781',
                    'instagram' => 'kerajinankayu',
                    'photo' => 'kerajinan.jpg',
                ],
                [
                    'user_id' => $umkmUser->id,
                    'name' => 'UMKM Kuliner Nusantara',
                    'description' => 'Makanan khas nusantara siap saji.',
                    'address' => 'Jl. Kuliner No. 4, Jakarta',
                    'phone' => '08123456782',
                    'whatsapp' => '628123456782',
                    'instagram' => 'kulinernusantara',
                    'photo' => 'makanan.jpg',
                ],
            ];
            foreach ($dummyUmkm as $umkm) {
                \App\Models\Umkm::firstOrCreate([
                    'name' => $umkm['name'],
                ], $umkm);
            }
    }
}