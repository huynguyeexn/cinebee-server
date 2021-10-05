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
        'name'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function premission(){
        return $this->belongsToMany(permissions::class,'permission_role','permission_id','role_id');
    }
}
