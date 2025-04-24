<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingTransactionItem extends Model
{
    public function sellingTransaction(){
        return $this->belongsTo('App\Models\SellingTransaction','transaction_id');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
}
