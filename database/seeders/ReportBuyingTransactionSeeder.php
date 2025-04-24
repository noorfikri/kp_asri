<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportBuyingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = DB::table('reports')->pluck('id')->toArray();
        $buyingTransactions = DB::table('buying_transactions')->pluck('id')->toArray();

        foreach ($reports as $reportId) {
            $randomBuyingTransactions = array_rand($buyingTransactions, rand(3, 7));
            foreach ((array) $randomBuyingTransactions as $transactionId) {
                DB::table('report_buying_transactions')->insert([
                    'report_id' => $reportId,
                    'buying_transaction_id' => $buyingTransactions[$transactionId],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
