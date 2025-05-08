<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportBuyingTransaction extends Model
{
    public function buyingTransaction(){
        return $this->belongsTo('App\Models\BuyingTransaction','buying_transaction_id');
    }

    public function report(){
        return $this->belongsTo('App\Models\Report','report_id');
    }
}
