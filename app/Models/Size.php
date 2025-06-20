<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function items()
    {
        return $this->belongsToMany(
            'App\Models\Item',
            'items_sizes',
            'size_id',
            'item_id'
        );
    }

    public function stocks()
    {
        return $this->hasMany(ItemStock::class, 'size_id');
    }
}
