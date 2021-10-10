<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showtime extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'room_id',
        'movie_id',
        'start_at',
        'end_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function movieTicket()
    {
        return $this->hasMany(MovieTicket::class);
    }

    public function movies()
    {
        return $this->belongsto(Movie::class);
    }

    public function rooms()
    {
        return $this->belongsto(Room::class);
    }
}
