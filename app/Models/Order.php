<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'total',
        'booking_at',
        'employee_id',
        'customer_id',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function comboTickets()
    {
        return $this->hasMany(ComboTicket::class);
    }

    public function movieTickets()
    {
        return $this->hasMany(movieTickets::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

}
