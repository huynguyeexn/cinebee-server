<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComboTicket extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'get_at',
        'quantity',
        'price',
        'combo_id',
        'order_id'
    ];

    protected $hidden = [
        'delete_at'
    ];

    public function orders()
    {
        return $this->belongsto(Order::class, "order_id");
    }
}
