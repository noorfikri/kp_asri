<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('store_info')->insert([
            'name' => env('STORE_NAME', 'Toko Ku'),
            'description' => env('STORE_DESC', 'Deskripsi Toko Ku, Kami adalah toko milikku (Silahkan Isi Deskripsi Toko Anda)'),
            'address_description' => "Toko Ku terletak pada alamat dibawah ini : (Silahkan sesuaikan sesuai yang anda mau)",
            'address' => env('STORE_ADDR', 'Alamat Toko Ku, Toko Ku beralamat pada sebuah alamat (Silahkan Isi Alamat Toko Anda)'),
            'banner' => 'assets/img/placeholder-banner.png',
            'logo' => 'assets/img/placeholder-logo.png',
            'home_image' => 'assets/img/placeholder_interior.jpg',
            'storefront_image' => 'assets/img/placeholder_exterior.jpg',
            'map_image' => 'assets/img/placeholder_map.jpg',
            'phone' => env('STORE_PHONE', '(081) 12345678 (Silahkan Isi Nomor Telepon Toko Anda)'),
            'whatsapp' => env('STORE_WHATSP', '(+62) 12345678 (Silahkan Isi Nomor Whatsapp Anda)'),
            'navbar_color' => "#555555",
            'bottom_bar_color' => "#555555",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
