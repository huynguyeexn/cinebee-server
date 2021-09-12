<?php

namespace App\Repositories\MovieDirector;

use App\Models\MovieDirector;
use App\Repositories\BaseRepository;

class MovieDirectorRepository extends BaseRepository implements MovieDirectorRepositoryInterface
{
    public function getModel()
    {
        return MovieDirector::class;
    }
}
