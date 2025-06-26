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
            'name' => 'Toko Asri Busana Muslim',
            'description' => 'Kami adalah toko baju busana muslim yang terletak pada tengah Kota, Kota Kediri. Kami menyediakan baju busana muslim baik untuk laki laki maupun perempuan. Selain busana muslim, kami juga menyediakan peralatan sholat, kurma dan air zam zam. Selain itu, kami juga menyediakan jasa pembuatan mahar nikah.',
            'address' => 'Jl. Raden Patah No.4, Kelurahan Kemasan, Kecamatan Kota, Kota Kediri, Jawa Timur',
            'banner' => 'assets/img/Banner ASRI.png',
            'logo' => 'assets/img/Logo ASRI.png',
            'phone' => '(0354) 689925',
            'whatsapp' => '(+62) 8145065711',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
