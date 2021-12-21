<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'get_at',
        'order_id',
        'price',
        'seat_id',
        'room_name',
        'seat_name',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function seats()
    {
        return $this->belongsTo(Seat::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, "order_id");
    }
}
