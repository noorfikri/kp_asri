<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SellingTransaction
 *
 * @property int $id
 * @property int $seller_id
 * @property string $date
 * @property int $discount_amount
 * @property int $total_amount
 * @property int $sub_total
 * @property int $total_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $seller
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $reports
 */
class SellingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'date',
        'discount_amount',
        'total_amount',
        'sub_total',
        'total_count',
    ];

    public function seller()
    {
        return $this->belongsTo(\App\Models\User::class, 'seller_id');
    }

    public function items()
    {
        return $this->belongsToMany(
            \App\Models\Item::class,
            'selling_transactions_items',
            'transaction_id',
            'item_id'
        )->withPivot('total_quantity', 'total_price')->withTimestamps();
    }

    public function reports()
    {
        return $this->belongsToMany(
            \App\Models\Report::class,
            'report_selling_transactions',
            'selling_transaction_id',
            'report_id'
        );
    }
}
