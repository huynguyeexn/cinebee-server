<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomStatus\StoreRequest;
use App\Http\Requests\RoomStatus\ListRequest;
use App\Http\Requests\RoomStatus\UpdateRequest;
use App\Models\RoomStatus;
use App\Repositories\RoomStatus\RoomStatusRepositoryInterface;

class RoomStatusController extends Controller
{
    /**
     * @var RoomStatusRepositoryInterface
     */
    protected $roomStatusRepo;

    public function __construct(RoomStatusRepositoryInterface $roomStatusRepo)
    {
        $this->roomStatusRepo = $roomStatusRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"RoomStatus"},
         *   path="/api/room-status",
         *   summary="RoomStatus index",
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

        $roomStatus = $this->roomStatusRepo->getList($request);

        return $roomStatus;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"RoomStatus"},
         *   path="/api/room-status",
         *   summary="Store new room status",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name"},
         *       @OA\Property(property="name", type="string"),
         *       example={"name": "Name of Room status"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = $request->only('name');

        return $this->roomStatusRepo->store($attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, RoomStatus $roomStatus, $id)
    {
        /**
         * @OA\Put(
         *   tags={"RoomStatus"},
         *   path="/api/room-status/{id}",
         *   summary="Update a room status",
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
         *       required={"name"},
         *       @OA\Property(property="name", type="string"),
         *       example={"name": "Name of Room status"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
        ];
        return $this->roomStatusRepo->update($id, $attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"RoomStatus"},
         *   path="/api/room-status/{id}/delete",
         *   summary="Delete a room status",
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
        return $this->roomStatusRepo->delete($id);
    }
}
