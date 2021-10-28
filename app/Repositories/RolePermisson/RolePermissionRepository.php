<?php
namespace App\Repositories\RolePermission;

use App\Models\EmployeeRole;
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

    public function create_role_permission($data = []){
         $idrole = EmployeeRole::find($data['role']);
         $permission = $data['permission'];
         $record = $idrole->premission()->sync($permission);
         if(empty($record['attached'])){
            return response(['message'=>"Thêm dữ liệu thất bại"],401);
         }else{
            return response(['message'=>"Thêm dữ liệu thành công"],201);
         }
        
    }

}
