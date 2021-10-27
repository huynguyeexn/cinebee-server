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
        'slug',
        'description'
    ];

    protected $hidden = [
        'delete_at'
    ];

    protected $appends = [
        'items', 'imgcombos'
    ];


    public function itemsFull()
    {
        return $this->belongsToMany(Item::class, 'combo_items');
    }

    public function getItemsAttribute()
    {
        return $this->itemsFull->pluck('id');
    }

    public function files()
    {
        return $this->belongsToMany(FileUpload::class, 'combo_files')->withPivot('type');
    }

    public function imgcombosFull()
    {
        return $this->belongsToMany(FileUpload::class, 'combo_files')->where('combo_files.type', 'like', 'imgcombos');
    }

    public function getImgCombosAttribute()
    {
        return $this->imgcombosFull->pluck('id');
    }

}
