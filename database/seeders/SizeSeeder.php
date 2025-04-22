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
        $sizes = ['Small', 'Medium', 'Large', 'X-Large', 'XX-Large'];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
            'name' => $size
            ]);
        }
    }
}
