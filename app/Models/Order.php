<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'booking_at',
        'employee_id',
        'customer_id',
        'showtime_id',
        'timeout',
    ];

    protected $dates = ['timeout', 'booking_at'];

    protected $hidden = [
        'deleted_at'
    ];

    protected $appends = [
        'movieTickets', 'payments', 'showtime', 'customer'
    ];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function showtime()
    {
        return $this->belongsTo(Showtime::class, 'showtime_id');
    }

    public function comboTickets()
    {
        return $this->hasMany(ComboTicket::class);
    }

    public function movieTickets()
    {
        return $this->hasMany(MovieTicket::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function getMovieTicketsAttribute()
    {
        return $this->movieTickets()->get();
    }

    public function getPaymentsAttribute()
    {
        return $this->payments()->get();
    }

    public function getShowtimeAttribute() {
        return $this->showtime()->first();
    }

    public function getCustomerAttribute() {
        return $this->customers()->first();
    }
}
