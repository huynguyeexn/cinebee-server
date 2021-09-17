<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\MovieActor\StoreRequest;
use App\Http\Requests\MovieActor\UpdateRequest;
use App\Repositories\MovieActor\MovieActorRepositoryInterface;
use Illuminate\Http\Request;

class MovieActorController extends Controller
{
    protected $movieActorRepo;

    public function __construct(MovieActorRepositoryInterface $movieActorRepo)
    {
        $this->movieActorRepo = $movieActorRepo;
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
         *   tags={"Movie Actors"},
         *   path="/api/movie-actors/",
         *   summary="List movie actors",
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
         *      description="actor per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort actor by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort actor type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->movieActorRepo->getList($request);
    }


    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Actors"},
         *   path="/api/movie-actors/deleted",
         *   summary="List Movie Actors Deleted",
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
         *      description="Actors per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort actors by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort actors type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->movieActorRepo->getDeletedList($request);
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
         *   tags={"Movie Actors"},
         *   path="/api/movie-actors",
         *   summary="Store new Movie Actors",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"movie_id", "actor_id"},
         *       @OA\Property(property="movie_id", type="integer"),
         *       @OA\Property(property="actor_id", type="integer"),
         *       example={"movie_id": "1", "actor_id": "1"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'movie_id' => $request->movie_id,
            'actor_id' => $request->actor_id,
        ];

        return $this->movieActorRepo->store($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovieActor  $movieActor
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Actors"},
         *   path="/api/movie-actors/{id}",
         *   summary="Get Movie Actors by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Room id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->movieActorRepo->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovieActor  $movieActor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Movie Actors"},
         *   path="/api/movie-actors/{id}",
         *   summary="Update new Movie Actors",
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
         *       required={"movie_id", "actor_id"},
         *       @OA\Property(property="movie_id", type="integer"),
         *       @OA\Property(property="actor_id", type="integer"),
         *       example={"movie_id": "1", "actor_id": "1"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'movie_id' => $request->movie_id,
            'actor_id' => $request->actor_id,
        ];

        return $this->movieActorRepo->update($id, $attributes);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movie Actors"},
         *   path="/api/movie-actors/{id}/remove",
         *   summary="Remove Movie Actors",
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
        return $this->movieActorRepo->remove($id);
    }
}
