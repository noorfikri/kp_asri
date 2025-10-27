<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
}
