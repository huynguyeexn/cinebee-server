<?php

namespace Database\Seeders;

use App\Models\EmployeeRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeRoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_roles')->insert([
            'name' => 'Nhân Viên',
        ]);
        DB::table('employee_roles')->insert([
            'name' => 'Quản Lý',
        ]);
    }
}
