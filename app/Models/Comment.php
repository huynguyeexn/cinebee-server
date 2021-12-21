<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_at',
        'content',
        'like',
        'dislike',
        'status',
        'customer_id',
        'movie_id',
    ];

    protected $appends = [
        'customer'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function getCustomerAttribute()
    {
        return $this->customer()->first();
    }
}
