<?php

namespace App\Repositories\ComboTicketDetail;

use App\Models\ComboTicketDetail;
use App\Repositories\BaseRepository;

class ComboTicketDetailRepository extends BaseRepository implements ComboTicketDetailRepositoryInterface
{
    public function getModel()
    {
        return ComboTicketDetail::class;
    }
}