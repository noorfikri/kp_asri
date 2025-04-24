<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellingTransactionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::table('items')->pluck('id')->toArray();

        $transactions = DB::table('selling_transactions')->get();

        foreach ($transactions as $transaction) {
            $totalAmount = 0;
            $totalCount = 0;

            $itemCount = rand(2, 5);
            for ($i = 1; $i <= $itemCount; $i++) {
                $itemId = $items[array_rand($items)];
                $quantity = rand(1, 10);
                $price = rand(50000, 200000);
                $totalAmount += $quantity * $price;
                $totalCount += $quantity;

                DB::table('selling_transactions_items')->insert([
                    'transaction_id' => $transaction->id,
                    'item_id' => $itemId,
                    'total_quantity' => $quantity,
                    'total_price' => $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('selling_transactions')->where('id', $transaction->id)->update([
                'total_amount' => $totalAmount,
                'total_count' => $totalCount
            ]);
        }
    }
}
