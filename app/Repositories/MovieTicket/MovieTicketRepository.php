<?php

namespace App\Repositories\MovieTicket;

use App\Models\MovieTicket;
use App\Repositories\BaseRepository;

class MovieTicketRepository extends BaseRepository implements MovieTicketRepositoryInterface
{
    public function getModel()
    {
        return MovieTicket::class;
    }
}
