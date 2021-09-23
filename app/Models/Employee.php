<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

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
        'deleted_at'
    ];

    public function employeeRoles()
    {
        return $this->belongsto(EmployeeRole::class);
    }
}
