<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;
use Illuminate\Support\Facades\DB;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan data dummy komunitas
        DB::table('communities')->insert([
            [
                'name' => 'Komunitas UMKM Kreatif',
                'slug' => 'komunitas-umkm-kreatif',
                'description' => 'Komunitas yang berfokus pada pengembangan UMKM kreatif di Yogyakarta.',
                'photo' => 'community/umkm_kreatif.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Komunitas Digital Marketing',
                'slug' => 'komunitas-digital-marketing',
                'description' => 'Komunitas belajar digital marketing untuk pelaku UMKM.',
                'photo' => 'community/digital_marketing.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Komunitas Pengrajin Lokal',
                'slug' => 'komunitas-pengrajin-lokal',
                'description' => 'Tempat berkumpul para pengrajin lokal untuk berbagi ilmu dan pengalaman.',
                'photo' => 'community/pengrajin_lokal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
