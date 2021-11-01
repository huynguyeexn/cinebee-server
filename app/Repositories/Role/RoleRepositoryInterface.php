<?php

namespace App\Repositories\Role;

use App\Repositories\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    public function getEmployees($id);
    public function storeRolePermission($attributes = []);
    public function getById_role_pe($id);
    public function update_role_pe($id,$attributes = []);
    public function delete_role_pe($id);
}
