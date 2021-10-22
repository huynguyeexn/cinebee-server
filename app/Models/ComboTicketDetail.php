<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboTicketDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'combo_ticket_id',
        'quantity',
        'price',
    ];
}
