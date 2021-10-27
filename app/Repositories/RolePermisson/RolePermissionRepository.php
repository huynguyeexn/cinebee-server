<?php
namespace App\Repositories\RolePermission;

use App\Models\Role\permissions;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class RolePermissionRepository extends BaseRepository implements RolePermissionRepositoryInterface
{
    public function getModel()
    {
        return permissions::class;
    }


    public function getListPermissionsALl(){
        $data = permissions::all();
         return ['data'=>$data];
    }

    public function getListPer_Role(){
        $data = DB::table('permission_role')->get()->toArray();
        return ['data'=>$data];
    }

}
