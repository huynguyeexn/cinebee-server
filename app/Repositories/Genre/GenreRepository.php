<?php 

namespace App\Repositories\Genre;

use App\Models\Genre;
use App\Repositories\BaseRepository;

class GenreRepository extends BaseRepository implements GenreRepositoryInterface
{
    public function getModel()
    {
        return Genre::class;
    }
   
}