<?php

namespace App\Repositories\MovieGenre;

use App\Models\MovieGenre;
use App\Repositories\BaseRepository;

class MovieGenreRepository extends BaseRepository implements MovieGenreRepositoryInterface
{
    public function getModel()
    {
        return MovieGenre::class;
    }
}
