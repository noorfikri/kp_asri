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
            'Baju Koko', 'Gamis Pria', 'Sarung Tenun', 'Hijab Pashmina',
            'Mukena Katun', 'Kemeja Batik', 'Kaos Polos', 'Celana Chino',
            'Jaket Bomber', 'Sweater Rajut', 'Blouse Muslimah', 'Rok Panjang',
            'Kaftan Satin', 'Jilbab Segi Empat', 'Tunik Modis', 'Outer Panjang'
        ];

        $notes = [
            'Desain elegan dan nyaman dipakai.',
            'Cocok untuk acara formal maupun santai.',
            'Terbuat dari bahan berkualitas tinggi.',
            'Tersedia dalam berbagai warna dan ukuran.',
            'Ringan dan nyaman untuk digunakan sepanjang hari.',
            'Dirancang untuk memenuhi kebutuhan fashion modern.',
            'Mudah dirawat dan tahan lama.',
            'Pilihan tepat untuk melengkapi gaya Anda.',
            'Menggabungkan tradisi dengan gaya kontemporer.',
            'Ideal untuk suasana formal dan kasual.',
            'Bahan lembut dan tidak panas di kulit.',
            'Cocok untuk digunakan sehari-hari.',
            'Memberikan kesan anggun dan sopan.',
            'Pilihan terbaik untuk busana muslimah.',
            'Didesain dengan detail yang menarik.',
            'Nyaman dipakai dalam berbagai aktivitas.'
        ];

        $descriptions = [
            'Produk ini dibuat dengan bahan berkualitas tinggi untuk memberikan kenyamanan maksimal.',
            'Dirancang dengan gaya modern yang cocok untuk berbagai kesempatan.',
            'Memiliki detail unik yang menambah kesan elegan.',
            'Pilihan sempurna untuk melengkapi koleksi pakaian Anda.',
            'Tersedia dalam berbagai pilihan warna yang menarik.',
            'Produk ini mudah dirawat dan tahan lama.',
            'Cocok untuk digunakan dalam berbagai aktivitas sehari-hari.',
            'Menggabungkan kenyamanan dan gaya dalam satu produk.',
            'Didesain untuk memberikan kesan profesional dan rapi.',
            'Pilihan ideal untuk Anda yang mengutamakan kualitas dan gaya.',
            'Produk ini memberikan kenyamanan sepanjang hari.',
            'Dirancang dengan perhatian terhadap detail untuk hasil terbaik.',
            'Cocok untuk semua usia dan berbagai acara.',
            'Menawarkan kombinasi sempurna antara tradisi dan inovasi.',
            'Produk ini memberikan nilai lebih untuk penampilan Anda.',
            'Pilihan terbaik untuk Anda yang ingin tampil percaya diri.'
        ];

        $sizeIds = DB::table('sizes')->pluck('id')->toArray();
        $colourIds = DB::table('colours')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $brandIds = DB::table('brands')->pluck('id')->toArray();


        for ($i = 1; $i <= 20; $i++) {
            $itemId = DB::table('items')->insertGetId([
                'name' => $names[array_rand($names)],
                'price' => rand(50000, 500000),
                'stock' => rand(50, 500),
                'note' => $notes[array_rand($notes)],
                'description' => $descriptions[array_rand($descriptions)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'brand_id' => $brandIds[array_rand($brandIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $randomSizes = array_rand($sizeIds, rand(1, 3));
            foreach ((array) $randomSizes as $sizeIndex) {
                DB::table('items_sizes')->insert([
                    'item_id' => $itemId,
                    'size_id' => $sizeIds[$sizeIndex],
                ]);
            }

            $randomColours = array_rand($colourIds, rand(1, 3));
            foreach ((array) $randomColours as $colourIndex) {
                DB::table('items_colours')->insert([
                    'item_id' => $itemId,
                    'colour_id' => $colourIds[$colourIndex],
                ]);
            }
        }
    }
}
