<?php

namespace App\Repositories\Showtime;

use App\Models\Showtime;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function getLatestShowtime()
    {
        $data = $this->model->where('start', '>=', Carbon::now()->sub('hour', 1))->orderBy('start', 'asc')->get();
        return response()->json([
            'data' => $data,
            'total' => $data->count(),
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => 1,
            'per_page' => 1,
            'last_page' => 1,
        ], 200);
    }

    public function getMoviesPlaying()
    {
        $data = $this->model->select('movie_id')->where('start', '>=', Carbon::now()->sub('hour', 1))->groupBy('movie_id')->get();
        return response()->json([
            'data' => $data,
            'total' => $data->count(),
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => 1,
            'per_page' => 1,
            'last_page' => 1,
        ], 200);
    }

    public function getByMovieId($id)
    {
        $data = $this->model->where('movie_id', $id)->where('start', '>=', Carbon::now()->sub('hour', 1))->get()->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->start)->format('d-M-y');
        });
        return response()->json([
            'data' => $data,
            'total' => $data->count(),
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => 1,
            'per_page' => 1,
            'last_page' => 1,
        ], 200);
    }

    public function getByDate($date)
    {

        $from = date(Carbon::parse($date)->toDateString());
        $to = date(Carbon::parse($from)->addDays(1)->toDateString());

        $data = $this->model->whereBetween('start', [$from, $to])->where('start', '>=', Carbon::now()->sub('hour', 1))->get();
        return response()->json([
            'data' => $data,
            'total' => $data->count(),
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => 1,
            'per_page' => 1,
            'last_page' => 1,
        ], 200);
    }
}
