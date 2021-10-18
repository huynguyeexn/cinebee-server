<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_at',
        'payment_status_id',
        'employee_id',
        'customer_id',
        'combo_ticket_id',
        'movie_ticket_id',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function paymentStatuses()
    {
        return $this->belongsto(PaymentStatus::class,'payment_status_id');
    }

    public function employees()
    {
        return $this->belongsto(Employee::class,'employee_id');
    }

    public function customers()
    {
        return $this->belongsto(Customer::class,'customer_id');
    }

    public function movieTickets()
    {
        return $this->belongsto(movieTickets::class,'movie_ticket_id');
    }

    public function comboTickets()
    {
        return $this->belongsto(comboTickets::class,'combo_ticket_id');
    }
}