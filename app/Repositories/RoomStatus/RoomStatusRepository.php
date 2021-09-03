<?php

namespace App\Repositories\RoomStatus;

use App\Models\RoomStatus;
use App\Repositories\BaseRepository;

class RoomStatusRepository extends BaseRepository implements RoomStatusRepositoryInterface
{
    public function getModel()
    {
        return RoomStatus::class;
    }
}
