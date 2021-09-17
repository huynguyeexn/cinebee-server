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

    public function getMovies($id)
    {
        $data = $this->model->findOrFail($id)->movies;
        $count = $data->count();
        return response()->json([
            'data' => $data,
            'total' => $count,
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => 1,
            'per_page' => $count,
            'last_page' => 1,
        ], 200);
    }
}
