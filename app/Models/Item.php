<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $stock
 * @property string $image
 * @property string $description
 * @property string $note
 * @property int $category_id
 * @property int $brand_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Size[] $size
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Colour[] $colour
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BuyingTransaction[] $buyingTransactions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SellingTransaction[] $sellingTransactions
 */
class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'image',
        'description',
        'note',
        'category_id',
        'brand_id',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class);
    }

    public function size()
    {
        return $this->belongsToMany(\App\Models\Size::class, 'items_sizes', 'item_id', 'size_id');
    }

    public function colour()
    {
        return $this->belongsToMany(\App\Models\Colour::class, 'items_colours', 'item_id', 'colour_id');
    }

    public function buyingTransactions()
    {
        return $this->belongsToMany(
            \App\Models\BuyingTransaction::class,
            'buying_transactions_items',
            'item_id',
            'transaction_id'
        )->withPivot('total_quantity', 'total_price')->withTimestamps();
    }

    public function sellingTransactions()
    {
        return $this->belongsToMany(
            \App\Models\SellingTransaction::class,
            'selling_transactions_items',
            'item_id',
            'transaction_id'
        )->withPivot('total_quantity', 'total_price')->withTimestamps();
    }
}
