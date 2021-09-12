<?php

namespace App\Repositories\MovieActor;

use App\Repositories\RepositoryInterface;

interface MovieActorRepositoryInterface extends RepositoryInterface
{
    public function getByActor($id);
}
