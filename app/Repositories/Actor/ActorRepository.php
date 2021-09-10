<?php
// long add 06-09-2021
namespace App\Repositories\Actor;

use App\Models\Actor;

use App\Repositories\BaseRepository;

class ActorRepository extends BaseRepository implements ActorRepositoryInterface
{
    public function getModel()
    {
        return Actor::class;
    }
}
