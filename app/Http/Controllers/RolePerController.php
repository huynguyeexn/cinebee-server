<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Repositories\RolePermission\RolePermissionRepositoryInterface;
use Illuminate\Http\Request;

class RolePerController extends Controller
{
    protected $rolePermission;

    public function __construct(RolePermissionRepositoryInterface $roleP)
    {
        $this->rolePermission = $roleP;
    }
    public function index(){
        /**
         *  @OA\Get(
         *   tags={"Permission"},
         *   path="/api/permission",
         *   summary="List permissions",
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
         return $this->rolePermission->getListPermissionsALl();
    }
    public function List_Role_Per(){
        /**
         * @OA/Get(
         *  tags={"Permission"}
         *  path="/api/permission/permission_role",
         *  summary="List permission_role",
         *  @OA\Response(response=200, description="OK"),
         *  @OA\response(response=401, description="Unauthorized"),
         *  @OA\response(response=404, description="Not Found"),
         * )
         */
        return $this->rolePermission->getListPer_Role();
    }

    public function create_permisison_role(Request $request){
         $data = [
            "role"=>$request->role,
            "permission"=>$request->permission
         ];
         return $this->rolePermission->create_role_permission($data);
    }

    public function edit_role_pe($id){
        return $this->rolePermission->edit_role_pe($id);
    }
    public function update(Request $request, $id){
        $data = [
            "role"=>$request->role,
            "permission"=>$request->permission
        ];
        return $this->rolePermission->Update_role_pe($data,$id);
    }
    public function delete($id){
        return $this->rolePermission->delete($id);
    }
}
