<?php

namespace App\Repositories\EmployeeRole;

use App\Models\EmployeeRole;
use App\Repositories\BaseRepository;

class EmployeeRoleRepository extends BaseRepository implements EmployeeRoleRepositoryInterface
{
    public function getModel()
    {
        return EmployeeRole::class;
    }
}
