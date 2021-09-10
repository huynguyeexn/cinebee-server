<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Actor extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'actor';
    protected $fillable = [
        'fullname',
        'avatar',
        'slug'
    ];
    protected $hidden = [
        'deleted_at'
    ];
}