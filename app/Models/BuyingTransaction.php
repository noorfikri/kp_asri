<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingTransaction extends Model
{
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier','supplier_id');
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
}
