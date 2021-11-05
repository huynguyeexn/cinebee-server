<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Showtime\ListShowtime;
use App\Http\Requests\Showtime\StoreRequest;
use App\Http\Requests\Showtime\UpdateRequest;
use App\Models\Showtime;
use App\Repositories\Showtime\ShowtimeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowtimeController extends Controller
{
    /**
     * @var ShowtimeRepositoryInterface
     */
    protected $ShowtimeRepo;

    public function __construct(ShowtimeRepositoryInterface $ShowtimeRepo)
    {
        $this->ShowtimeRepo = $ShowtimeRepo;
    }

    public function index(ListShowtime $request)
    {
        /**
         * @OA\Get(
         *   tags={"Showtime"},
         *   path="/api/showtimes",
         *   summary="List Showtime",
         *   @OA\Parameter(
         *      name="date",
         *      in="query",
         *      description="date",
         *      example="2021-10-23T22:04:30+07:00",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        $sql = Showtime::query();

        $from = date(Carbon::parse($request->date)->toDateString());
        $to = date(Carbon::parse($from)->addDays(1)->toDateString());

        $sql->whereBetween('start', [$from, $to])->get();

        $child =  ["movie", "room"];
        $data = $sql->with($child)->get();

        return [
            'data' => $data,
            'from' => $from,
            'to' => $to,
            'pagination' => []
        ];
    }


    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Showtime"},
         *   path="/api/showtimes/{id}",
         *   summary="Get Showtime by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Item id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ShowtimeRepo->getById($id);
    }

    public function getByMovieId($id)
    {
        /**
         * @OA\Get(
         *   tags={"Showtime"},
         *   path="/api/showtimes/movie/{id}",
         *   summary="Get Showtime by movie id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Movie id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ShowtimeRepo->getByMovieId($id);
    }

    public function getByDate($date)
    {
        /**
         * @OA\Get(
         *   tags={"Showtime"},
         *   path="/api/showtimes/movie/{date}",
         *   summary="Get Showtime by movie date",
         *   @OA\Parameter(
         *      name="date",
         *      in="path",
         *      required=true,
         *      description="Showtime by date",
         *      example="21",
         *     @OA\Schema(type="string"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ShowtimeRepo->getByDate($date);
    }

    public function update(Request $request)
    {
        /**
         * @OA\Put(
         *   tags={"Showtime"},
         *   path="/api/showtimes/{id}",
         *   summary="Update a Showtime",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"room_id", "movie_id", "start", "end"},
         *       @OA\Property(property="room_id", type="integer"),
         *       @OA\Property(property="movie_id", type="integer"),
         *       @OA\Property(property="start", type="timestamp"),
         *       @OA\Property(property="end", type="timestamp"),
         *       example={"room_id": "1", "movie_id": "1", "start":"2021-09-21 12:15:00", "end":"2021-09-21 14:00:00"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */


        // $attributes = [
        //     'room_id' => $request->room_id,
        //     'movie_id' => $request->movie_id,
        //     'start' => $request->start,
        //     'end' => $request->end,
        // ];

        // return $this->ShowtimeRepo->update($id, $attributes);

        if (isset($request->deleted)) {
            Showtime::destroy($request->deleted);
        }

        DB::table('showtimes')->upsert(
            $request->events,
            ['id'],
            ["room_id", 'start', 'end']
        );
        return response([
            'message' => 'Đã lưu !',
            'data' => $this->ShowtimeRepo->getList($request, ["movie", "room"]),
        ], 200);
    }

    public function movieTicket($id)
    {
        /**
         * @OA\Get(
         *   tags={"Showtime"},
         *   path="/api/showtimes/{id}/movie-ticket",
         *   summary="List Showtime",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="search",
         *      in="query",
         *      description="Search by",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="q",
         *      in="query",
         *      description="Search query",
         *     @OA\Schema(type="string")
         *   ),
         *     @OA\Parameter(
         *      name="page",
         *      in="query",
         *      description="Page",
         *      example="1",
         *     @OA\Schema(type="number")
         *   ),
         *     @OA\Parameter(
         *      name="per_page",
         *      in="query",
         *      description="Items per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort items by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort items type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        return $this->ShowtimeRepo->getMovieTicket($id);
    }

    public function latest()
    {
        /**
         * @OA\Get(
         *   tags={"Showtime"},
         *   path="/api/showtimes/latest",
         *   summary="List Showtime latest",
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        return $this->ShowtimeRepo->getLatestShowtime();
    }

    public function moviesPlaying()
    {
        /**
         * @OA\Get(
         *   tags={"Showtime"},
         *   path="/api/showtimes/movie-playing",
         *   summary="List Showtime movie-playing",
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        return $this->ShowtimeRepo->getMoviesPlaying();
    }
}
