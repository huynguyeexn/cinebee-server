<?php
// long add 06-09-2021
namespace App\Http\Controllers;

use App\Http\Requests\Actor\StoreRequest;
use App\Http\Requests\Actor\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Models\Actor;
use App\Repositories\Actor\ActorRepositoryInterface;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    protected $ActorRepo;
    public function __construct(ActorRepositoryInterface $ActorRepo)
    {
        $this->ActorRepo = $ActorRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Actor"},
         *   path="/api/actors/",
         *   summary="List actor",
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
        return $this->ActorRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Actor"},
         *   path="/api/actors/deleted",
         *   summary="List Actor Deleted",
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
        return $this->ActorRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Actor"},
         *   path="/api/actors",
         *   summary="Store new actor",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"fullname", "slug","avatar"},
         *       @OA\Property(property="fullname", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       @OA\Property(property="avatar", type="string"),
         *       example={"fullname": "hailong", "slug": "hai-long","avatar":"anh_cua_toi.jpg"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'fullname' => $request->fullname,
            'slug' => $request->slug,
            'avatar' => $request->avatar
        ];
        return $this->ActorRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Actor"},
         *   path="/api/actors/{id}",
         *   summary="Get actor by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="actor id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ActorRepo->getById($id);
    }

    public function getBySlug($slug)
    {
        /**
         * @OA\Get(
         *   tags={"Actor"},
         *   path="/api/actors/{slug}",
         *   summary="Get Actor by slug",
         *   @OA\Parameter(
         *      name="slug",
         *      in="path",
         *      required=true,
         *      description="actors slug",
         *      example="actor",
         *     @OA\Schema(type="string"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ActorRepo->getBySlug($slug);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Actor"},
         *   path="/api/actors/{id}",
         *   summary="Update a Actor",
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
         *       required={"fullname", "slug","avatar"},
         *       @OA\Property(property="fullname", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       @OA\Property(property="avatar", type="string"),
         *       example={"fullname": "longhai", "slug": "long-hai","avatar":"anh_moi_doi.png"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'fullname' => $request->fullname,
            'slug' => $request->slug,
            'avatar' => $request->avatar
        ];

        return $this->ActorRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Actor"},
         *   path="/api/actors/{id}/delete",
         *   summary="Delete a Actor",
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
        return $this->ActorRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Actor"},
         *   path="/api/actors/{id}/remove",
         *   summary="Remove Actor from trash",
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
        return $this->ActorRepo->remove($id);
    }

    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Actor"},
         *   path="/api/actors/{id}/restore",
         *   summary="Restore actor from trash",
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
        return $this->ActorRepo->restore($id);
    }

    public function movies($id)
    {
        /**
         * @OA\Get(
         *   tags={"Actor"},
         *   path="/api/actors/{id}/movies",
         *   summary="List actor",
         *     @OA\Parameter(
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

        return $this->ActorRepo->getMovies($id);
    }
}
