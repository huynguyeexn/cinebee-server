<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeatStatus\ListRequest;
use App\Http\Requests\SeatStatus\StoreRequest;
use App\Http\Requests\SeatStatus\UpdateRequest;
use App\Models\SeatStatus;
use App\Repositories\SeatStatus\SeatStatusRepositoryInterface;

class SeatStatusController extends Controller
{
    /**
     * @var SeatStatusRepositoryInterface
     */
    protected $seatStatusRepo;

    public function __construct(SeatStatusRepositoryInterface $seatStatusRepo)
    {
        $this->seatStatusRepo = $seatStatusRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status",
         *   summary="List Seat Status",
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
        return $this->seatStatusRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status/deleted",
         *   summary="List Seat Status",
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
        return $this->seatStatusRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status",
         *   summary="Store new Seat Status",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name", "slug"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       example={"name": "Status of seat", "slug": "status-of-seat"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];
        return $this->seatStatusRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status/{id}",
         *   summary="Get Seat Status by id",
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
        return $this->seatStatusRepo->getById($id);
    }

    public function getBySlug($slug)
    {
        /**
         * @OA\Get(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status/{slug}",
         *   summary="Get Seat Status by slug",
         *   @OA\Parameter(
         *      name="slug",
         *      in="path",
         *      required=true,
         *      description="Status slug",
         *      example="status-of-seat",
         *     @OA\Schema(type="string"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->seatStatusRepo->getBySlug($slug);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status/{id}",
         *   summary="Update a Seat Status",
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
         *       required={"name", "slug"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       example={"name": "Status of seat", "slug": "status-of-seat"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];

        return $this->seatStatusRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status/{id}/delete",
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
        return $this->seatStatusRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status/{id}/remove",
         *   summary="Remove Seat Status from trash",
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
        return $this->seatStatusRepo->remove($id);
    }

    public function restore(SeatStatus $seatStatus, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"SeatStatus"},
         *   path="/api/seat-status/{id}/restore",
         *   summary="Restore Seat Status from trash",
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
        return $this->seatStatusRepo->restore($id);
    }
}
