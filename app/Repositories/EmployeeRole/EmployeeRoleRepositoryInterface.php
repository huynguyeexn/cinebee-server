<?php

namespace App\Repositories\EmployeeRole;

use App\Repositories\RepositoryInterface;

interface EmployeeRoleRepositoryInterface extends RepositoryInterface
{
    public function getEmployees($id);
}