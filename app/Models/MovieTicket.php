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
        'showtime_id',
        'room_id',
        'seat_code',
        'seat_text',
        'price'
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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}