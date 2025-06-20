<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    use HasFactory;

    protected $table = 'items_stock';

    protected $fillable = [
        'item_id',
        'size_id',
        'colour_id',
        'stock',
    ];

    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    public function size()
    {
        return $this->belongsTo(\App\Models\Size::class, 'size_id');
    }

    public function colour()
    {
        return $this->belongsTo(\App\Models\Colour::class, 'colour_id');
    }

    public function buyingTransactionItems()
    {
        return $this->hasMany(BuyingTransactionItem::class, 'items_stock_id');
    }

    public function sellingTransactionItems()
    {
        return $this->hasMany(SellingTransactionItem::class, 'items_stock_id');
    }
}
