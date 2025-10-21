<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreInfo extends Model
{
    use HasFactory;

    protected $table = 'store_info';

    protected $fillable = [
        'name',
        'description',
        'address',
        'banner',
        'logo',
        'phone',
        'whatsapp',
        'navbar_color',
        'bottom_bar_color',
        'text_color',
        'text_secondary_color',
        'home_image',
        'storefront_image',
        'map_image',
        'address_description',
    ];
}
