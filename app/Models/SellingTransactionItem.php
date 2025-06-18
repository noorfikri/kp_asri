<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Supplier
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $telephone
 * @property string $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BuyingTransaction[] $buyingTransactions
 */
class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'telephone',
        'picture',
    ];

    /**
     * Get the buying transactions for the supplier.
     */
    public function buyingTransactions()
    {
        return $this->hasMany(\App\Models\BuyingTransaction::class, 'supplier_id');
    }
}
