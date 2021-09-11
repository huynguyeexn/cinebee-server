<?php

namespace App\Repositories\Director;

use App\Models\Director;
use App\Repositories\BaseRepository;

class DirectorRepository extends BaseRepository implements DirectorRepositoryInterface
{
    public function getModel()
    {
        return Director::class;
    }
}
