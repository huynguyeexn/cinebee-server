<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'trailer',
        'description',
        'release_date',
        'running_time',
        'age_rating_id',
        'status',
    ];

    protected $appends = [
        'genres', 'actors', 'directors', 'posters',
        'backdrops'
    ];

    public function ageRating()
    {
        return $this->belongsTo(AgeRating::class);
    }

    public function genresFull()
    {
        return $this->belongsToMany(Genre::class, 'movie_genres');
    }

    public function actorsFull()
    {
        return $this->belongsToMany(Actor::class, 'movie_actors');
    }

    public function directorsFull()
    {
        return $this->belongsToMany(Director::class, 'movie_directors');
    }
    public function files()
    {
        return $this->belongsToMany(FileUpload::class, 'movie_files')->withPivot('type');
    }
    public function postersFull()
    {
        return $this->belongsToMany(FileUpload::class, 'movie_files')->where('movie_files.type', 'like', 'poster');
    }
    public function backdropsFull()
    {
        return $this->belongsToMany(FileUpload::class, 'movie_files')->where('movie_files.type', 'like', 'backdrop');
    }

    public function getGenresAttribute()
    {
        return $this->genresFull->pluck('id');
    }
    public function getActorsAttribute()
    {
        return $this->actorsFull->pluck('id');
    }
    public function getDirectorsAttribute()
    {
        return $this->directorsFull->pluck('id');
    }
    public function getPostersAttribute()
    {
        return $this->postersFull->pluck('id');
    }
    public function getBackdropsAttribute()
    {
        return $this->backdropsFull->pluck('id');
    }

    public function showtime()
    {
        return $this->hasMany(Showtime::class);
    }
}
