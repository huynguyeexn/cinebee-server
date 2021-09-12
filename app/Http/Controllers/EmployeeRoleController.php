<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\EmployeeRole\StoreRequest;
use App\Http\Requests\EmployeeRole\UpdateRequest;
use App\Models\EmployeeRole;
use App\Repositories\EmployeeRole\EmployeeRoleRepositoryInterface;

class EmployeeRoleController extends Controller
{
    /**
     * @var EmployeeRoleRepositoryInterface
     */
    protected $employeeRoleRepo;

    public function __construct(EmployeeRoleRepositoryInterface $employeeRoleRepo)
    {
        $this->employeeRoleRepo = $employeeRoleRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role",
         *   summary="List Employee Role",
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
        return $this->employeeRoleRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role/deleted",
         *   summary="List Employee Role Deleted",
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
        return $this->employeeRoleRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role",
         *   summary="Store new Employee Role",
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
        return $this->employeeRoleRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role/{id}",
         *   summary="Get Employee Role by id",
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
        return $this->employeeRoleRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role/{id}",
         *   summary="Update a Employee Role",
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

        return $this->employeeRoleRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role/{id}/delete",
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
        return $this->employeeRoleRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role/{id}/remove",
         *   summary="Remove Employee Role from trash",
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
        return $this->employeeRoleRepo->remove($id);
    }

    public function restore(EmployeeRole $employeeRole, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role/{id}/restore",
         *   summary="Restore Employee Role from trash",
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
        return $this->employeeRoleRepo->restore($id);
    }

    public function employees($id)
    {
        /**
         * @OA\Get(
         *   tags={"EmployeeRole"},
         *   path="/api/employee-role",
         *   summary="List Employee Role",
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

        return $this->employeeRoleRepo->getEmployees($id);
    }
}
