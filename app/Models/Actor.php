<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use SoftDeletes;
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
