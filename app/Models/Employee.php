<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject
{
    // use HasFactory, SoftDeletes;
    use HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'phone',
        'email',
        'address',
        'id_card',
        'birthday',
        'gender',
        'employee_role_id',
    ];

    protected $hidden = [
        'deleted_at',
        'password'
    ];

    protected $appends = ['permissions'];

    public function Role()
    {
        return $this->belongsTo(Role::class, 'employee_role_id');
    }

    public function getPermissionsAttribute()
    {
        return $this->Role->permissions;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
