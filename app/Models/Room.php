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
        "room_status_id",
        "rows",
        "cols",
        "price",
    ];

    protected $hidden = [
        'delete_at'
    ];

    protected $appends = [
        'seats',
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function showtime()
    {
        return $this->hasMany(Showtime::class);
    }

    public function getSeatsAttribute()
    {
        return $this->seats()->get();
    }
}
