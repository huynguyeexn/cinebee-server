<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

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
}
