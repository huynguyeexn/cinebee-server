<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Model\Role;
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

    public function Role()
    {
        return $this->belongsto(Role::class,'employee_role_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
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
