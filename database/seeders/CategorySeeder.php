<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Makanan',
            'Minuman',
            'Kerajinan',
            'Jasa',
            'Fashion',
            'Kesehatan',
            'Elektronik',
            'Rumah Tangga',
            'Pertanian',
            'Otomotif',
        ];

        foreach ($categories as $category) {
            \DB::table('categories')->updateOrInsert(
                ['name' => $category],
                ['updated_at' => now()] // Only update timestamp if exists, or insert if not
            );
        }
    }
}
