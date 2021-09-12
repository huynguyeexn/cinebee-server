<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\MovieDirector\StoreRequest;
use App\Http\Requests\MovieDirector\UpdateRequest;
use App\Repositories\MovieDirector\MovieDirectorRepositoryInterface;
use Illuminate\Http\Request;

class MovieDirectorController extends Controller
{
    /**
     * @var MovieDirectorRepositoryInterface
     */
    protected $movieDirectorRepo;

    public function __construct(MovieDirectorRepositoryInterface $movieDirectorRepo)
    {
        $this->movieDirectorRepo = $movieDirectorRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Director"},
         *   path="/api/movie-director",
         *   summary="List Movie Director",
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
        return $this->movieDirectorRepo->getList($request);
    }


    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Director"},
         *   path="/api/movie-director/deleted",
         *   summary="List Movie Director Deleted",
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
        return $this->movieDirectorRepo->getDeletedList($request);
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
         *   tags={"Movie Director"},
         *   path="/api/movie-director",
         *   summary="Store new Movie Director",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"movie_id", "director_id"},
         *       @OA\Property(property="movie_id", type="string"),
         *       @OA\Property(property="director_id", type="string"),
         *       example={"director_id": "1", "director_id": "1"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'movie_id' => $request->movie_id,
            'director_id' => $request->director_id,
        ];

        return $this->movieDirectorRepo->store($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovieDirector $movieDirector
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movie Director"},
         *   path="/api/movie-director/{id}",
         *   summary="Get Movie Director by id",
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
        return $this->movieDirectorRepo->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovieDirector $movieDirector
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Movie Director"},
         *   path="/api/movie-director/{id}",
         *   summary="Update new Movie Director",
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
         *       required={"movie_id", "director_id"},
         *       @OA\Property(property="movie_id", type="integer"),
         *       @OA\Property(property="director_id", type="integer"),
         *       example={"movie_id": "1", "director_id": "1"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'movie_id' => $request->movie_id,
            'director_id' => $request->director_id,
        ];

        return $this->movieDirectorRepo->update($id, $attributes);
    }


    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movie Director"},
         *   path="/api/movie-director/{id}/delete",
         *   summary="Delete a Movie Director",
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
        return $this->movieDirectorRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movie Director"},
         *   path="/api/movie-director/{id}/remove",
         *   summary="Remove Movie Director from trash",
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
        return $this->movieDirectorRepo->remove($id);
    }

    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Movie Director"},
         *   path="/api/movie-director/{id}/restore",
         *   summary="Restore Movie Director from trash",
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
        return $this->movieDirectorRepo->restore($id);
    }
}
