<?php

namespace App\Repositories\Director;

use App\Repositories\RepositoryInterface;

interface DirectorRepositoryInterface extends RepositoryInterface
{
    public function getMovies($id);
}