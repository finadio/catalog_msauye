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
        \DB::table('categories')->insert([
            ['name' => 'Makanan'],
            ['name' => 'Minuman'],
            ['name' => 'Kerajinan'],
            ['name' => 'Jasa'],
            ['name' => 'Fashion'],
        ]);
    }
}
