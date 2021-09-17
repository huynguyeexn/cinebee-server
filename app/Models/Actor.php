<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'fullname',
        'avatar',
        'slug'
    ];
    protected $hidden = [
        'deleted_at'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class,'movie_actors');
    }
}
