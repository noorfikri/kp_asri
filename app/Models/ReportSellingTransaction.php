<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReportSellingTransaction
 *
 * @property int $id
 * @property int $report_id
 * @property int $selling_transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SellingTransaction $sellingTransaction
 * @property-read \App\Models\Report $report
 */
class ReportSellingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'selling_transaction_id',
    ];

    public function sellingTransaction()
    {
        return $this->belongsTo(\App\Models\SellingTransaction::class, 'selling_transaction_id');
    }

    public function report()
    {
        return $this->belongsTo(\App\Models\Report::class, 'report_id');
    }
}
