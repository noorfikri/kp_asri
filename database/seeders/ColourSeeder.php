<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ColourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colours = [
            'Crimson Red',
            'Ocean Blue',
            'Forest Green',
            'Sunflower Yellow',
            'Charcoal Black',
            'Ivory White',
            'Royal Purple',
            'Peach Pink',
            'Sky Blue',
            'Chocolate Brown'
        ];

        foreach ($colours as $colour) {
            DB::table('colours')->insert([
            'name' => $colour,
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }
    }
}
