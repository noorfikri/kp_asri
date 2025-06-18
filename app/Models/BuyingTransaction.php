<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BuyingTransaction
 *
 * @property int $id
 * @property int $supplier_id
 * @property string $date
 * @property int $total_amount
 * @property int $total_count
 * @property int $sub_total
 * @property int $discount_amount
 * @property int $other_cost
 * @property string $reciept_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Supplier $supplier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $reports
 */
class BuyingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'date',
        'total_amount',
        'total_count',
        'sub_total',
        'discount_amount',
        'other_cost',
        'reciept_image',
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

    public function items()
    {
        return $this->belongsToMany(
            'App\Models\Item',
            'buying_transactions_items',
            'transaction_id',
            'item_id'
        )->withPivot('total_quantity', 'total_price')->withTimestamps();
    }

    public function reports()
    {
        return $this->belongsToMany(
            Report::class,
            'report_buying_transactions',
            'buying_transaction_id',
            'report_id'
        );
    }
}
