<?php

namespace App\Repositories\AgeRating;

use App\Repositories\RepositoryInterface;

interface AgeRatingRepositoryInterface extends RepositoryInterface
{
    public function getMovies($id);
}
