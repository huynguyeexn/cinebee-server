<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        'slug'
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
