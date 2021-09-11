<?php

namespace App\Repositories\AgeRating;

use App\Models\AgeRating;

use App\Repositories\BaseRepository;

class AgeRatingRepository extends BaseRepository implements AgeRatingRepositoryInterface
{
    public function getModel()
    {
        return AgeRating::class;
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
