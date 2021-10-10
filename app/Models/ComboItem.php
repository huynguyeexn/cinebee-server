<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComboItem extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'combo_id',
        'item_id',
        'quantity'
    ];

    protected $hidden = [
        'delete_at'
    ];

}
