<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "label",
        "index",
        "room_id",
        "customer_id",
        "customer_username",
        "seat_status_id",
    ];

    public function room()
    {
        return $this->belongsTo(RoomStatus::class);
    }
}
