<?php

namespace App\Repositories\Showtime;

use App\Models\Showtime;
use App\Repositories\BaseRepository;

class ShowtimeRepository extends BaseRepository implements ShowtimeRepositoryInterface
{
    public function getModel()
    {
        return Showtime::class;
    }

    public function getMovieTicket($id)
    {
        $data = $this->model->findOrFail($id)->movieTicket;
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
