<?php

namespace App\Models;


use App\Models\Role\permissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'role';
    protected $fillable = [
        'name',
        'code',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $appends = [
        "permissions"
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function permissionsFull()
    {
        return $this->belongsToMany(permissions::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function getPermissionsAttribute()
    {
        return $this->permissionsFull->pluck('name');
    }
}
