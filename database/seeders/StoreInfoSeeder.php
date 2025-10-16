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
            'name' => env('STORE_NAME'),
            'description' => env('STORE_DESC'),
            'address' => env('STORE_ADDR'),
            'banner' => 'assets/img/placeholder-banner.png',
            'logo' => 'assets/img/placeholder-logo.png',
            'phone' => env('STORE_PHONE'),
            'whatsapp' => env('STORE_WHATSP'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
