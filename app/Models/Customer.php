<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes, Notifiable;

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
        return $this->belongsTo(CustomerType::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
