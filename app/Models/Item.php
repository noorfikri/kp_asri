<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function size()
    {
        return $this->belongsToMany(
            'App\Models\Size',
            'items_sizes',
            'item_id',
            'size_id'
        );
    }

    public function colour()
    {
        return $this->belongsToMany(
            'App\Models\Colour',
            'items_colours',
            'item_id',
            'colour_id'
        );
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }

    public function buyingTransactionItems()
    {
        return $this->hasMany('App\Models\BuyingTransactionItem', 'item_id');
    }

    public function buyingTransactions()
    {
        return $this->belongsToMany(
            'App\Models\BuyingTransaction',
            'buying_transactions_items',
            'item_id',
            'transaction_id'
        )->withPivot('total_quantity', 'total_price')->withTimestamps();
    }

    public function sellingTransactionItems()
    {
        return $this->hasMany('App\Models\SellingTransactionItem', 'item_id');
    }

    public function sellingTransactions()
    {
        return $this->belongsToMany(
            'App\Models\SellingTransaction',
            'selling_transactions_items',
            'item_id',
            'transaction_id'
        )->withPivot('total_quantity', 'total_price')->withTimestamps();
    }
}
