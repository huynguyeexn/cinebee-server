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
        'sex',
        'customer_type_id',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function customerTypes()
    {
        return $this->belongsto(CustomerType::class);
    }
}
