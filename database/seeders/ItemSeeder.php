<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Hijab Scarf', 'Abaya Dress', 'Kaftan Gown', 'Prayer Robe',
            'Modest Tunic', 'Long Skirt', 'Islamic Cap', 'Thobe',
            'Shawl Wrap', 'Modest Blouse'
        ];
        $notes = [
            'Elegant and modest design.',
            'Perfect for daily wear or special occasions.',
            'Crafted with premium quality fabric.',
            'Available in a variety of colors and sizes.',
            'Lightweight and comfortable for all-day wear.',
            'Designed to meet modern modest fashion needs.',
            'Easy to care for and long-lasting.',
            'A versatile addition to your wardrobe.',
            'Combines tradition with contemporary style.',
            'Ideal for formal and casual settings.'
        ];

        for ($i = 1; $i < 3; $i++) {
            for ($j = 1; $j < 3; $j++) {
            for ($k = 1; $k < 3; $k++) {
                for ($l = 1; $l < 3; $l++) {
                DB::table('items')->insert([
                    'name' => $names[array_rand($names)],
                    'price' => rand(50000, 500000),
                    'stock' => rand(50, 500),
                    'note' => $notes[array_rand($notes)],
                    'category_id' => $k,
                    'colour_id' => $j,
                    'size_id' => $i,
                    'brand_id' => $l
                ]);
                }
            }
            }
        }
    }
}
