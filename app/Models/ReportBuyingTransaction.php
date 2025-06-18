<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReportBuyingTransaction
 *
 * @property int $id
 * @property int $report_id
 * @property int $buying_transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BuyingTransaction $buyingTransaction
 * @property-read \App\Models\Report $report
 */
class ReportBuyingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'buying_transaction_id',
    ];

    public function buyingTransaction()
    {
        return $this->belongsTo(\App\Models\BuyingTransaction::class, 'buying_transaction_id');
    }

    public function report()
    {
        return $this->belongsTo(\App\Models\Report::class, 'report_id');
    }
}
