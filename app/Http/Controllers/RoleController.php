<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleController extends Controller
{
    /**
     * @var RoleRepositoryInterface
     */
    protected $RoleRepo;

    public function __construct(RoleRepositoryInterface $RoleRepo)
    {
        $this->RoleRepo = $RoleRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Role"},
         *   path="/api/role",
         *   summary="List Role",
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
         *      description="Role per page",
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
         *      description="Sort Role type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->RoleRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Role"},
         *   path="/api/role/deleted",
         *   summary="List Role Deleted",
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
        return $this->RoleRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Role"},
         *   path="/api/role",
         *   summary="Store new Role",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name", "slug"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       example={"name": "Nhân Viên", "slug": "nhan-vien"}
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
        return $this->RoleRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Role"},
         *   path="/api/role/{id}",
         *   summary="Get Role by id",
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
        return $this->RoleRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Role"},
         *   path="/api/role/{id}",
         *   summary="Update a Role",
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
         *       example={"name": "Nhân Viên", "slug": "nhan-vien"}
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

        return $this->RoleRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Role"},
         *   path="/api/role/{id}/delete",
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
        return $this->RoleRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Role"},
         *   path="/api/role/{id}/remove",
         *   summary="Remove Role from trash",
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
        return $this->RoleRepo->remove($id);
    }

    public function restore(Role $Role, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"Role"},
         *   path="/api/role/{id}/restore",
         *   summary="Restore Role from trash",
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
        return $this->RoleRepo->restore($id);
    }

    public function employees($id)
    {
        /**
         * @OA\Get(
         *   tags={"Role"},
         *   path="/api/role/{id}/employees",
         *   summary="List Role",
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

        return $this->RoleRepo->getEmployees($id);
    }
}
