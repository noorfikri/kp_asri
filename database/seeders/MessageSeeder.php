<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                'name' => 'Ahmad Fauzi',
                'subject' => 'Review Produk Hijab',
                'message' => 'Hijabnya sangat nyaman dipakai dan bahannya berkualitas.',
                'contact' => '081234567890',
                'category' => 'review',
            ],
            [
                'name' => 'Rina Kartika',
                'subject' => 'Review Pelayanan',
                'message' => 'Pelayanan sangat ramah dan pengiriman cepat.',
                'contact' => '082345678901',
                'category' => 'review',
            ],
            [
                'name' => 'Dian Pratama',
                'subject' => 'Review Produk Sarung',
                'message' => 'Sarungnya sangat bagus, motifnya menarik dan nyaman digunakan.',
                'contact' => '083456789012',
                'category' => 'review',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'subject' => 'Pesanan Hijab',
                'message' => 'Saya ingin memesan hijab warna hitam ukuran besar.',
                'contact' => '084567890123',
                'category' => 'order',
            ],
            [
                'name' => 'Budi Haryanto',
                'subject' => 'Pesanan Sarung',
                'message' => 'Saya ingin memesan 3 sarung dengan motif tradisional.',
                'contact' => '085678901234',
                'category' => 'order',
            ],
            [
                'name' => 'Lina Sari',
                'subject' => 'Pesanan Koko Shirt',
                'message' => 'Saya ingin memesan 2 baju koko ukuran L.',
                'contact' => '086789012345',
                'category' => 'order',
            ],
            [
                'name' => 'Dewi Lestari',
                'subject' => 'Pertanyaan Stok Produk',
                'message' => 'Apakah stok hijab warna biru masih tersedia?',
                'contact' => '086789012345',
                'category' => 'question',
            ],
            [
                'name' => 'Andi Wijaya',
                'subject' => 'Pertanyaan Pengiriman',
                'message' => 'Berapa lama waktu pengiriman ke Surabaya?',
                'contact' => '087890123456',
                'category' => 'question',
            ],
            [
                'name' => 'Siti Aminah',
                'subject' => 'Pertanyaan Pembayaran',
                'message' => 'Apakah bisa membayar dengan transfer bank?',
                'contact' => '088901234567',
                'category' => 'question',
            ],
            [
                'name' => 'Lina Sari',
                'subject' => 'Permintaan Kolaborasi',
                'message' => 'Apakah toko Anda tertarik untuk kolaborasi dengan kami?',
                'contact' => '088901234567',
                'category' => 'other',
            ],
            [
                'name' => 'Rudi Budiono',
                'subject' => 'Permintaan Sponsor',
                'message' => 'Kami ingin mengajukan permintaan sponsor untuk acara kami.',
                'contact' => '089012345678',
                'category' => 'other',
            ],
        ];

        foreach ($messages as $message) {
            DB::table('messages')->insert(array_merge($message, [
                'post_time' => now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
