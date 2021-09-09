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
        DB::table('employee_role')->insert([
            'name' => 'Nhân Viên',
            'slug' => 'nhan-vien',
        ]);
        DB::table('employee_role')->insert([
            'name' => 'Quản Lý',
            'slug' => 'quan-ly',
        ]);
    }
}
