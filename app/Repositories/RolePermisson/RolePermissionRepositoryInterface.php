<?php


namespace App\Repositories\RolePermission;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface RolePermissionRepositoryInterface extends RepositoryInterface
{
     public function getListPermissionsALl();
     public function getListPer_Role();
     public function create_role_permission($data = []);
     public function edit_role_pe($id);
     public function Update_role_pe($data = [], $id);
     public function delete($id);
}
