<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "row",
        "col",
        "room_id",
        "seat_status_id",
    ];

    public function room()
    {
        return $this->belongsto(RoomStatus::class);
    }
}
