<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingTransactionItem extends Model
{
    public function buyingTransaction(){
        return $this->belongsTo('App\Models\BuyingTransaction','transaction_id');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
}
