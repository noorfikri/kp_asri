<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $contact_number
 * @property string|null $address
 * @property string $profile_picture
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $category
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SellingTransaction[] $sellingTransactions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Report[] $reports
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'address',
        'profile_picture',
        'email_verified_at',
        'password',
        'category',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the selling transactions for the user.
     */
    public function sellingTransactions()
    {
        return $this->hasMany(\App\Models\SellingTransaction::class, 'seller_id');
    }

    /**
     * Get the reports created by the user.
     */
    public function reports()
    {
        return $this->hasMany(\App\Models\Report::class, 'creator_id');
    }
}
