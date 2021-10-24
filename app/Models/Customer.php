<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fullname',
        'username',
        'password',
        'phone',
        'email',
        'address',
        'birthday',
        'gender',
        'customer_type_id',
    ];

    protected $hidden = [
        'deleted_at',
        "password"
    ];

    public function customerTypes()
    {
        return $this->belongsto(CustomerType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
