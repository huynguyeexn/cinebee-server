<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserRole::insert(['name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
        UserRole::insert(['name' => 'staff', 'created_at' => now(), 'updated_at' => now()]);
        UserRole::insert(['name' => 'manager', 'created_at' => now(), 'updated_at' => now()]);

        User::factory(20)->create();
    }
}
