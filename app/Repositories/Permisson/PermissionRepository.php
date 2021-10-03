<?php 

namespace App\Repositories\Permission;

use App\Models\Role\permissions;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function getModel()
    {
        return permissions::class;
    }
    
}