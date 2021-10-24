<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'payment_status_id',
        'code_bank',
        'code_transaction',
        'note',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function paymentStatuses()
    {
        return $this->belongsto(PaymentStatus::class,'payment_status_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
