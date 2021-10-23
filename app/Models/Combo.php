<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'slug'
    ];

    protected $hidden = [
        'delete_at'
    ];

    protected $appends = [
        'items'
    ];


    public function itemsFull()
    {
        return $this->belongsToMany(Item::class, 'combo_items');
    }

    public function getItemsAttribute()
    {
        return $this->itemsFull->pluck('id');
    }
}
