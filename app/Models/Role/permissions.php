<?php

namespace App\Models\Role;

use App\Models\PermissionRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'prefix',
        'display_name'
    ];
    protected $hidden = [
        'deleted_at'
    ];
    public function role()
    {
        return $this->belongsToMany(PermissionRole::class, 'permission_role', 'permission_id', 'role_id');
    }
}
