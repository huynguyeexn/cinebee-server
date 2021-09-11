<?php
// long add 06-09-2021
namespace App\Repositories\Movie;

use App\Models\Movie;

use App\Repositories\BaseRepository;

class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{
    public function getModel()
    {
        return Movie::class;
    }
}
