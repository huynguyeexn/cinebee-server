<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Repositories\RolePermission\RolePermissionRepositoryInterface;


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
         * tags={"Permission"}
         * path="/api/permission/permission_role",
         * summary="List permission_role"
         * @OA\Response(response=200, description="OK"),
         * @OA\response(response=401, description="Unauthorized"),
         * @OA\response(response=404, description="Not Found")
         * )
         */
        return $this->rolePermission->getListPer_Role();
    }
}
