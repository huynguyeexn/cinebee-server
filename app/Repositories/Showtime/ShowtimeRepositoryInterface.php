<?php

namespace App\Repositories\Showtime;

use App\Repositories\RepositoryInterface;

interface ShowtimeRepositoryInterface extends RepositoryInterface
{
    public function getMovieTicket($id);

    public function getLatestShowtime();

    public function getMoviesPlaying();

    public function getByMovieId($id);

    public function getByDate($date, $movie_id);
}
