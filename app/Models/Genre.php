<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug'
    ];
    protected $hidden = [
        'deleted_at'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class,'movie_genres');
    }
}
