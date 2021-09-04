<?php

namespace App\Repositories\Seat;

use App\Models\Seat;
use App\Repositories\BaseRepository;

class SeatRepository extends BaseRepository implements SeatRepositoryInterface
{
    public function getModel()
    {
        return Seat::class;
    }
}
