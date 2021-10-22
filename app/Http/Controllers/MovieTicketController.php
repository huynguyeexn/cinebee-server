<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\MovieTicket\StoreRequest;
use App\Http\Requests\MovieTicket\UpdateRequest;
use App\Models\MovieTicket;
use App\Repositories\MovieTicket\MovieTicketRepositoryInterface;
use Illuminate\Http\Request;

class MovieTicketController extends Controller
{
    /**
     * @var MovieTicketRepositoryInterface
     */
    protected $movieTicketRepo;

    public function __construct(MovieTicketRepositoryInterface $movieTicketRepo)
    {
        $this->movieTicketRepo = $movieTicketRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets",
         *   summary="List Movie Ticket",
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
        return $this->movieTicketRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets/deleted",
         *   summary="List Movie Ticket Deleted",
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
        return $this->movieTicketRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets",
         *   summary="Store new Movie Ticket",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "get_at", "showtime_id", "room_id", "seat_text", "seat_code", "price"},
         *       @OA\Property(property="get_at", type="date"),
         *       @OA\Property(property="showtime_id", type="integer"),
         *       @OA\Property(property="room_id", type="integer"),
         *       @OA\Property(property="seat_code", type="integer"),
         *       @OA\Property(property="seat_text", type="string"),
         *       @OA\Property(property="price",    type="float"),
         *       example={"get_at": "21/09/2021", "showtime_id": "1", "room_id": "1", "seat_text": "A1", "seat_code": "1", "price": "45.000"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'get_at' => $request->get_at,
            'showtime_id' => $request->showtime_id,
            'room_id' => $request->room_id,
            'seat_code' => $request->seat_code,
            'seat_text' => $request->seat_text,
            'price'    => $request->price,
        ];
        return $this->movieTicketRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets/{id}",
         *   summary="Get Movie Ticket by id",
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
        return $this->movieTicketRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets/{id}",
         *   summary="Update a Movie Ticket",
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
         *       required={ "get_at", "showtime_id", "room_id", "seat_text", "seat_code", "price"},
         *       @OA\Property(property="get_at", type="date"),
         *       @OA\Property(property="showtime_id", type="integer"),
         *       @OA\Property(property="room_id", type="integer"),
         *       @OA\Property(property="seat_code", type="integer"),
         *       @OA\Property(property="seat_text", type="string"),
         *       @OA\Property(property="price",    type="float"),
         *       example={"get_at": "21/09/2021", "showtime_id": "1", "room_id": "1", "seat_text": "A1", "seat_code": "1", "price": "45.000"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'get_at' => $request->get_at,
            'showtime_id' => $request->showtime_id,
            'room_id' => $request->room_id,
            'seat_code' => $request->seat_code,
            'seat_text' => $request->seat_text,
            'price'    => $request->price,
        ];

        return $this->movieTicketRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets/{id}/delete",
         *   summary="Delete a Movie Ticket",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        return $this->movieTicketRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets/{id}/remove",
         *   summary="Remove Movie Ticket from trash",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        return $this->movieTicketRepo->remove($id);
    }

    public function restore(MovieTicket $movieTicket, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"Movie Ticket"},
         *   path="/api/movie-tickets/{id}/restore",
         *   summary="Restore Movie Ticket from trash",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        return $this->movieTicketRepo->restore($id);
    }
}
