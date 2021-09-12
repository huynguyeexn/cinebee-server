<?php

namespace App\Repositories\Director;

use App\Models\Director;
use App\Repositories\BaseRepository;

class DirectorRepository extends BaseRepository implements DirectorRepositoryInterface
{
    public function getModel()
    {
        return Director::class;
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
