<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyingTransactionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = DB::table('items')->pluck('id')->toArray();

        $transactions = DB::table('buying_transactions')->get();

        foreach ($transactions as $transaction) {
            $totalAmount = 0;
            $totalCount = 0;
            $discount = rand(50000, 500000);
            $other_cost = rand(50000, 500000);

            $itemCount = rand(2, 5);
            for ($i = 1; $i <= $itemCount; $i++) {
                $itemId = $items[array_rand($items)];
                $quantity = rand(1, 10);
                $price = DB::table('items')->where('id',$itemId)->value('price');
                $totalPrice = $quantity * $price;
                $totalAmount += $totalPrice;
                $totalCount += $quantity;

                DB::table('buying_transactions_items')->insert([
                    'transaction_id' => $transaction->id,
                    'item_id' => $itemId,
                    'total_quantity' => $quantity,
                    'total_price' => $totalPrice,
                ]);
            }

            DB::table('buying_transactions')->where('id', $transaction->id)->update([
                'sub_total' => $totalAmount,
                'total_amount' => $totalAmount + $other_cost - $discount,
                'other_cost' => $other_cost,
                'discount_amount' => $discount,
                'total_count' => $totalCount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
