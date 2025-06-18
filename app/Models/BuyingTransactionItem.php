<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BuyingTransactionItem
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $item_id
 * @property int $total_quantity
 * @property int $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BuyingTransaction $buyingTransaction
 * @property-read \App\Models\Item $item
 */
class BuyingTransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'item_id',
        'total_quantity',
        'total_price',
    ];

    public function buyingTransaction()
    {
        return $this->belongsTo('App\Models\BuyingTransaction', 'transaction_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
