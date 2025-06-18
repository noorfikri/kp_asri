<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Report
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $report_date
 * @property string $type
 * @property int $total_buying
 * @property int $total_selling
 * @property int $other_cost
 * @property int $cash_flow
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BuyingTransaction[] $buyingTransactions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SellingTransaction[] $sellingTransactions
 */
class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'type',
        'total_buying',
        'total_selling',
        'other_cost',
        'cash_flow',
        'creator_id',
    ];

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'creator_id');
    }

    public function buyingTransactions()
    {
        return $this->belongsToMany(
            \App\Models\BuyingTransaction::class,
            'report_buying_transactions',
            'report_id',
            'buying_transaction_id'
        )->withTimestamps();
    }

    public function sellingTransactions()
    {
        return $this->belongsToMany(
            \App\Models\SellingTransaction::class,
            'report_selling_transactions',
            'report_id',
            'selling_transaction_id'
        )->withTimestamps();
    }
}
