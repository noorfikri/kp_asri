<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSellingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = DB::table('reports')->pluck('id')->toArray();
        $sellingTransactions = DB::table('selling_transactions')->pluck('id')->toArray();

        foreach ($reports as $reportId) {
            $randomSellingTransactions = array_rand($sellingTransactions, rand(3, 7));
            foreach ((array) $randomSellingTransactions as $transactionId) {
                DB::table('report_selling_transactions')->insert([
                    'report_id' => $reportId,
                    'selling_transaction_id' => $sellingTransactions[$transactionId],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
