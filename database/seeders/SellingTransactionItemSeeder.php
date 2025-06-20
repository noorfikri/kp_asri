<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellingTransactionItemSeeder extends Seeder
{
    public function run()
    {
        $itemsStock = DB::table('items_stock')->pluck('id')->toArray();
        $transactions = DB::table('selling_transactions')->get();

        foreach ($transactions as $transaction) {
            $totalAmount = 0;
            $totalCount = 0;
            $discount = rand(50000, 500000);

            $itemCount = rand(2, 5);
            for ($i = 1; $i <= $itemCount; $i++) {
                $itemsStockId = $itemsStock[array_rand($itemsStock)];
                $quantity = rand(1, 10);
                $itemId = DB::table('items_stock')->where('id', $itemsStockId)->value('item_id');
                $price = DB::table('items')->where('id', $itemId)->value('price');
                $totalPrice = $quantity * $price;
                $totalAmount += $totalPrice;
                $totalCount += $quantity;

                DB::table('selling_transactions_items')->insert([
                    'transaction_id' => $transaction->id,
                    'items_stock_id' => $itemsStockId,
                    'total_quantity' => $quantity,
                    'total_price' => $totalPrice,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Update stock in items_stock
                DB::table('items_stock')->where('id', $itemsStockId)->decrement('stock', $quantity);
            }

            DB::table('selling_transactions')->where('id', $transaction->id)->update([
                'sub_total' => $totalAmount,
                'total_amount' => $totalAmount - $discount,
                'total_count' => $totalCount,
                'discount_amount' => $discount,
                'updated_at' => now(),
            ]);
        }
    }
}
