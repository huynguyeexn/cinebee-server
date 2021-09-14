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
        'thumbnail',
        'description',
        'release_date',
        'running_time',
        'age_rating_id',
    ];

    public function ageRating()
    {
        return $this->belongsto(AgeRating::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'movie_genres');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class,'movie_actors');
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class,'movie_directors');
    }

}
