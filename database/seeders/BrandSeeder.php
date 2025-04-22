<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Hijabista', 'MuslimWear', 'ModestStyle'];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
            'name' => $brand
            ]);
        }
    }
}
