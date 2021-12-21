<?php

namespace App\Models;

use Carbon\Carbon;
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
        'movie', 'room', 'invalidSeats'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
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

    public function getInvalidSeatsAttribute() {
        $orders = Order::where('timeout', '>', Carbon::now())
        ->orWhereNull('timeout')
        ->where('showtime_id', $this->id)->pluck('id')->toArray();
        $result = [];
        foreach ($orders as $order) {
            $seats = MovieTicket::where('order_id', $order)->pluck('seat_id')->toArray();
            $result = array_merge($result, $seats);
        }

        return $result;
    }
}
