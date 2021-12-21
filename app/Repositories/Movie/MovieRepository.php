<?php
// long add 06-09-2021
namespace App\Repositories\Movie;

use App\Models\Movie;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

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

    public function getComments($id, Request $request = null)
    {
        $model = $this->model;
        $sql = $model::findOrFail($id)->comments();

        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;

        $total = $sql->count();
        $data = $sql->offset(($page - 1) * $per_page)->limit($per_page)->get();
        return response()->json([
            'data' => $data,
            'total' => $total,
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => $page,
            'per_page' => $per_page,
            'last_page' => ceil($total / $per_page),
        ], 200);
    }
}
