<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserRole::insert(['name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        UserRole::insert(['name' => 'staff', 'created_at' => now(), 'updated_at' => now()]);
        UserRole::insert(['name' => 'manager', 'created_at' => now(), 'updated_at' => now()]);
    }
}
