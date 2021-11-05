<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'room_id',
        'movie_id',
        'start',
        'end'
    ];

    protected $dates = ['end', 'start'];

    protected $hidden = [
        'deleted_at'
    ];

    protected $appends = [
        'movie', 'room'
    ];

    public function movieTicket()
    {
        return $this->hasMany(MovieTicket::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getMovieAttribute()
    {
        return $this->movie()->first();
    }

    public function getRoomAttribute()
    {
        return $this->room()->first();
    }
}
