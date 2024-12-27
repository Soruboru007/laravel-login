<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert the categories
        $categories = [
            ['category_name' => 'N1', 'created_at' => now('Asia/Tokyo'), 'updated_at' => now('Asia/Tokyo')],
            ['category_name' => 'N2', 'created_at' => now('Asia/Tokyo'), 'updated_at' => now('Asia/Tokyo')],
            ['category_name' => 'N3', 'created_at' => now('Asia/Tokyo'), 'updated_at' => now('Asia/Tokyo')],
            ['category_name' => 'N4', 'created_at' => now('Asia/Tokyo'), 'updated_at' => now('Asia/Tokyo')],
            ['category_name' => 'N5', 'created_at' => now('Asia/Tokyo'), 'updated_at' => now('Asia/Tokyo')],
        ];

        DB::table('categories')->insert($categories);
    }
}
