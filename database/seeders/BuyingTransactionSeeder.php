<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = DB::table('suppliers')->pluck('id')->toArray();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('buying_transactions')->insert([
                'supplier_id' => $suppliers[array_rand($suppliers)],
                'date' => date('Y-m-d', strtotime('-' . rand(1, 30) . ' days')),
                'total_amount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
