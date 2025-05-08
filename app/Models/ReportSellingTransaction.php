<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSellingTransaction extends Model
{
    public function sellingTransaction(){
        return $this->belongsTo('App\Models\SellingTransaction','selling_transaction_id');
    }

    public function report(){
        return $this->belongsTo('App\Models\Report','report_id');
    }
}
