<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'name' => 'Nhân Viên',
            'code' => 'staff',
        ]);
        DB::table('role')->insert([
            'name' => 'Quản Lý',
            'code' => 'manager',
        ]);
        DB::table('role')->insert([
            'name' => 'Super Man',
            'code' => 'super_admin',
        ]);
    }
}
