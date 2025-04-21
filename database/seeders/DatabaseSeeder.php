<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call(CategorySeeder::class);
        $this->call(ColourSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ItemSeeder::class);
    }
}
