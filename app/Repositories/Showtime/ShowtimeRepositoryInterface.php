<?php

namespace App\Repositories\Showtime;

use App\Repositories\RepositoryInterface;

interface ShowtimeRepositoryInterface extends RepositoryInterface
{
    public function getMovieTicket($id);
}
