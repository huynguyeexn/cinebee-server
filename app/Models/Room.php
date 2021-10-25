<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "room_status_id"
    ];

    protected $hidden = [
        'delete_at'
    ];

    public function roomSatus()
    {
        return $this->belongsto(RoomStatus::class);
    }


    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
