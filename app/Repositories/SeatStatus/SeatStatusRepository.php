<?php

namespace App\Repositories\SeatStatus;

use App\Models\SeatStatus;
use App\Repositories\BaseRepository;

class SeatStatusRepository extends BaseRepository implements SeatStatusRepositoryInterface
{
    public function getModel()
    {
        return SeatStatus::class;
    }
}
