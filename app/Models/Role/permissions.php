<?php

namespace App\Models\Role;

use App\Models\EmployeeRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'display_name'
    ];
    protected $hidden = [
        'deleted_at'
    ];
    public function role()
    {
        return $this->belongsToMany(EmployeeRole::class,'permission_role','role_id','permission_id');
    }
}
