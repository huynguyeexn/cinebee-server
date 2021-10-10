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

    public function getActors($id)
    {
        $data = $this->model->findOrFail($id)->actors;
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

    public function getGenres($id)
    {
        $data = $this->model->findOrFail($id)->genres;
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

    public function getDirectors($id)
    {
        $data = $this->model->findOrFail($id)->directors;
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

    public function getShowtimes($id)
    {
        $data = $this->model->findOrFail($id)->showtimes;
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
