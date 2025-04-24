<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingTransaction extends Model
{
    public function seller(){
        return $this->belongsTo('App\Models\User','seller_id');
    }

    public function items()
    {
        return $this->belongsToMany(
            'App\Models\Item',
            'selling_transactions_items',
            'transaction_id',
            'item_id'
        )->withPivot('total_quantity', 'total_price')->withTimestamps();
    }

    public function reports()
    {
        return $this->belongsToMany(
            Report::class,
            'report_selling_transactions',
            'selling_transaction_id',
            'report_id'
        );
    }
}
