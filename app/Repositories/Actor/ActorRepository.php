<?php
// long add 06-09-2021
namespace App\Repositories\Actor;

use App\Models\Actor;

use App\Repositories\BaseRepository;

class ActorRepository extends BaseRepository implements ActorRepositoryInterface
{
    public function getModel()
    {
        return Actor::class;
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
