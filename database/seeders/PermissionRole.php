<?php

namespace Database\Seeders;

use App\Models\Role;
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
        DB::table('permission_role')->truncate();
        $permission = permissions::all('id');
        $role = Role::where('code', 'super_admin')->first();
        foreach ($permission as $id) {
            DB::table('permission_role')->insert([
                'role_id' => $role->id,
                'permission_id' => $id->id
            ]);
        }
    }
}
