<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('selling_transactions')->insert([
                'seller_id' => $users[array_rand($users)],
                'date' => date('Y-m-d', strtotime('-' . rand(1, 30) . ' days')),
                'total_amount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
