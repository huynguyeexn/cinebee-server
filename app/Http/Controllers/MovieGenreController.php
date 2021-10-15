<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\MovieGenre\StoreRequest;
use App\Http\Requests\MovieGenre\UpdateRequest;
use App\Repositories\MovieGenre\MovieGenreRepositoryInterface;
use Illuminate\Http\Request;

class MovieGenreController extends Controller
{
    protected $movieGenreRepo;

    public function __construct(MovieGenreRepositoryInterface $movieGenreRepo)
    {
        $this->movieGenreRepo = $movieGenreRepo;
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
         *   tags={"Movie Genres"},
         *   path="/api/movie-genres/",
         *   summary="List movie Genres",
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
        return $this->movieGenreRepo->getList($request);
    }


    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Genres"},
         *   path="/api/movie-genres/deleted",
         *   summary="List Movie Genres Deleted",
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
        return $this->movieGenreRepo->getDeletedList($request);
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
         *   tags={"Movie Genres"},
         *   path="/api/movie-genres",
         *   summary="Store new Movie Genres",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"movie_id", "genre_id"},
         *       @OA\Property(property="movie_id", type="integer"),
         *       @OA\Property(property="genre_id", type="integer"),
         *       example={"movie_id": "1", "genre_id": "1"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'movie_id' => $request->movie_id,
            'genre_id' => $request->genre_id,
        ];

        return $this->movieGenreRepo->store($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovieGenre  $movieGenre
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Genres"},
         *   path="/api/movie-genres/{id}",
         *   summary="Get Movie Genres by id",
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
        return $this->movieGenreRepo->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovieGenre  $movieGenre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Movie Genres"},
         *   path="/api/movie-genres/{id}",
         *   summary="Update new Movie Genres",
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
         *       required={"movie_id", "genre_id"},
         *       @OA\Property(property="movie_id", type="integer"),
         *       @OA\Property(property="genre_id", type="integer"),
         *       example={"movie_id": "1", "genre_id": "1"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'movie_id' => $request->movie_id,
            'genre_id' => $request->genre_id,
        ];

        return $this->movieGenreRepo->update($id, $attributes);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movie Genres"},
         *   path="/api/movie-genres/{id}/remove",
         *   summary="Remove Movie Genres",
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
        return $this->movieGenreRepo->remove($id);
    }
}
