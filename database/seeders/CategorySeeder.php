<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Baju Koko', 'Hijab', 'Mukena', 'Sarung', 'Peci', 'Gamis', 'Sajadah'];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
            'name' => $category,
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }
    }
}
