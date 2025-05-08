<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemColour extends Model
{
    public function colour(){
        return $this->belongsTo('App\Models\Colour','colour_id');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
}
