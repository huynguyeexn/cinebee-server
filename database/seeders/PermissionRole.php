<?php

namespace Database\Seeders;

use App\Models\EmployeeRole;
use App\Models\Role\permissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = permissions::all('id');
        $EmployeeRole = EmployeeRole::where('id','=',2)->first();
        foreach($permission as $id){
            DB::table('permission_role')->insert([
                'role_id'=>$EmployeeRole->id,
                'permission_id'=>$id->id
            ]);
        }
    }
}
