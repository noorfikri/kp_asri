<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
            'name' => $size,
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }
    }
}
