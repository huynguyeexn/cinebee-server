<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $fillable = [
        'name'
    ];

    /**
     * Get the users for the user role.
     */
    public function users()
    {
        $this->hasMany(User::class);
    }
}
