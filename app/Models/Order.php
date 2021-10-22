<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'total',
        'total_quantity',
        'employee',
        'customer',
        'movie_ticket_detail',
        'combo_ticket_detail',
        'booking_at',
    ];

    protected $hidden = [
        'deleted_at'
    ];

}