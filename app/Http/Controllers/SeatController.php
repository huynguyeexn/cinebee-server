<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Seat\StoreRequest;
use App\Http\Requests\Seat\UpdateRequest;
use App\Models\Seat;
use App\Repositories\Seat\SeatRepositoryInterface;
use Illuminate\Http\Request;

class SeatController extends Controller
{

    protected $seatRepo;

    public function __construct(SeatRepositoryInterface $seatRepo)
    {
        $this->seatRepo = $seatRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Seat"},
         *   path="/api/seats",
         *   summary="List Seats",
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
        return $this->seatRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Seat"},
         *   path="/api/seats/deleted",
         *   summary="List Seat Deleted",
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
        return $this->seatRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        //
        /**
         * @OA\Post(
         *   tags={"Seat"},
         *   path="/api/seats",
         *   summary="Store new Seat",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name", "row", "col", "room_id", "seat_status_id"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="row", type="number"),
         *       @OA\Property(property="col", type="number"),
         *       @OA\Property(property="room_id", type="number"),
         *       @OA\Property(property="seat_status_id", type="number"),
         *       example={"name": "Ghế 1", "col": 0, "row": 0, "room_id": 1, "seat_status_id": 1}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
            'row' => $request->row,
            'col' => $request->col,
            'room_id' => $request->room_id,
            'seat_status_id' => $request->seat_status_id,
        ];
        return $this->seatRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Seat"},
         *   path="/api/seats/{id}",
         *   summary="Get Seat by id",
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
        return $this->seatRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Seat"},
         *   path="/api/seats/{id}",
         *   summary="Update a Seat",
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
         *       required={"name", "row", "col", "room_id", "seat_status_id"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="row", type="number"),
         *       @OA\Property(property="col", type="number"),
         *       @OA\Property(property="room_id", type="number"),
         *       @OA\Property(property="seat_status_id", type="number"),
         *       example={"name": "Ghế 1", "col": 0, "row": 0, "room_id": 1, "seat_status_id": 1}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
            'row' => $request->row,
            'col' => $request->col,
            'room_id' => $request->room_id,
            'seat_status_id' => $request->seat_status_id,
        ];

        return $this->seatRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Seat"},
         *   path="/api/seats/{id}/delete",
         *   summary="Delete a Seat",
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
        return $this->seatRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Seat"},
         *   path="/api/seats/{id}/remove",
         *   summary="Remove Room from trash",
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
        return $this->seatRepo->remove($id);
    }

    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Seat"},
         *   path="/api/seats/{id}/restore",
         *   summary="Restore Room from trash",
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
        return $this->seatRepo->restore($id);
    }
}
