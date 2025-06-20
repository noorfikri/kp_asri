<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    public function items()
    {
        return $this->belongsToMany(
            'App\Models\Item',
            'items_colours',
            'colour_id',
            'item_id'
        );
    }

    public function stocks()
    {
        return $this->hasMany(ItemStock::class, 'colour_id');
    }
}
