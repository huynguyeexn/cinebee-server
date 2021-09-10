<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Genre extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'genre';
    protected $fillable = [
        'name',
        'slug'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}