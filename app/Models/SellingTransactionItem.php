<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SellingTransactionItem
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $item_id
 * @property int $total_quantity
 * @property int $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SellingTransaction $sellingTransaction
 * @property-read \App\Models\Item $item
 */
class SellingTransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'item_id',
        'total_quantity',
        'total_price',
    ];

    public function sellingTransaction()
    {
        return $this->belongsTo(\App\Models\SellingTransaction::class, 'transaction_id');
    }

    public function itemsStock()
    {
        return $this->belongsTo('App\Models\ItemsStock', 'items_stock_id');
    }
}
