<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
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
            'Pilihan tepat untuk tampil modis setiap hari.',
            'Ringan dan mudah dipadupadankan.',
            'Memberikan kesan anggun dan modern.',
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

        $descriptions = [
            'Bahan katun premium, nyaman dipakai seharian.',
            'Motif menarik dan warna tidak mudah pudar.',
            'Cocok untuk acara formal maupun santai.',
            'Mudah dicuci dan tidak mudah kusut.',
            'Desain modern dan kekinian.',
            'Jahitan rapi dan kuat.',
            'Tersedia berbagai ukuran.',
            'Pilihan warna lengkap.',
            'Ringan dan adem di kulit.',
            'Tidak panas saat dipakai.',
            'Bahan berkualitas tinggi.',
            'Cocok untuk hadiah keluarga.',
            'Model terbaru tahun ini.',
            'Harga terjangkau dengan kualitas terbaik.',
            'Produk best seller di toko kami.',
            'Limited edition, segera miliki sekarang!',
        ];

        $sizeIds = DB::table('sizes')->pluck('id')->toArray();
        $colourIds = DB::table('colours')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $brandIds = DB::table('brands')->pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $itemId = DB::table('items')->insertGetId([
                'name' => $names[array_rand($names)],
                'price' => rand(50000, 500000),
                'note' => $notes[array_rand($notes)],
                'description' => $descriptions[array_rand($descriptions)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'brand_id' => $brandIds[array_rand($brandIds)],
                'image' => 'assets/img/Placeholder_Image.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Generate 2-4 random size/colour combinations for each item
            $combCount = rand(2, 4);
            $usedCombinations = [];
            for ($j = 0; $j < $combCount; $j++) {
                $sizeId = $sizeIds[array_rand($sizeIds)];
                $colourId = $colourIds[array_rand($colourIds)];
                $key = $sizeId . '-' . $colourId;
                // Avoid duplicate combinations for the same item
                if (isset($usedCombinations[$key])) continue;
                $usedCombinations[$key] = true;

                DB::table('items_stock')->insert([
                    'item_id' => $itemId,
                    'size_id' => $sizeId,
                    'colour_id' => $colourId,
                    'stock' => rand(10, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
