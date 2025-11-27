<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'approved',
            'pending',
            'rejected',
        ];

        foreach ($statuses as $status) {
            \DB::table('product_statuses')->updateOrInsert([
                'name' => $status
            ], [
                'name' => $status
            ]);
        }
    }
}
