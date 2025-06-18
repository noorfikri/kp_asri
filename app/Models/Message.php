<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $subject
 * @property string $category
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $post_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'subject',
        'category',
        'message',
        'post_time',
    ];
}
