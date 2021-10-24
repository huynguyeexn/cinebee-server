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
        'price',
        'order_id',
        'showtime_id',
        'room_id',
        'seat_id',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function showtimes()
    {
        return $this->belongsto(Showtime::class);
    }

    public function seats()
    {
        return $this->belongsto(Seat::class);
    }

    public function orders()
    {
        return $this->belongsto(Order::class, "order_id");
    }
}
