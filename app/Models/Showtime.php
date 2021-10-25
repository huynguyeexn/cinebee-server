<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showtime extends Model
{
    use HasFactory, SoftDeletes;

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
}
