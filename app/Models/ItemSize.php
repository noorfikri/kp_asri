<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSize extends Model
{
    public function size(){
        return $this->belongsTo('App\Models\Size','size_id');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
}
