<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
            'name' => 'Supplier A',
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'telephone' => '081234567890',
            ],
            [
            'name' => 'Supplier B',
            'address' => 'Jl. Sudirman No. 456, Bandung',
            'telephone' => '082345678901',
            ],
            [
            'name' => 'Supplier C',
            'address' => 'Jl. Diponegoro No. 789, Surabaya',
            'telephone' => '083456789012',
            ],
        ]);
    }
}
