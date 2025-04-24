<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function creator(){
        return $this->belongsTo('App\Models\User','creator_id');
    }

    public function buyingTransactions()
    {
        return $this->belongsToMany(
            BuyingTransaction::class,
            'report_buying_transactions',
            'report_id',
            'buying_transaction_id'
        )->withTimestamps();
    }

    public function sellingTransactions()
    {
        return $this->belongsToMany(
            SellingTransaction::class,
            'report_selling_transactions',
            'report_id',
            'selling_transaction_id'
        )->withTimestamps();
    }
}
