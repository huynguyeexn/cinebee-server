<?php

namespace App\Repositories\Room;

use App\Repositories\RepositoryInterface;

interface RoomRepositoryInterface extends RepositoryInterface
{
    //
    public function getSeats($id);
}
