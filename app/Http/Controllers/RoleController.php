<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use App\Models\Role\permissions;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
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
    public function getListPermissions(){
        $data = permissions::all();
        return ['data'=>$data];
    }
//    public function deleted(ListRequest $request)
//    {
//        /**
//         * @OA\Get(
//         *   tags={"Role"},
//         *   path="/api/role/deleted",
//         *   summary="List Role Deleted",
//         *   @OA\Parameter(
//         *      name="search",
//         *      in="query",
//         *      description="Search by",
//         *     @OA\Schema(type="string")
//         *   ),
//         *   @OA\Parameter(
//         *      name="q",
//         *      in="query",
//         *      description="Search query",
//         *     @OA\Schema(type="string")
//         *   ),
//         *     @OA\Parameter(
//         *      name="page",
//         *      in="query",
//         *      description="Page",
//         *      example="1",
//         *     @OA\Schema(type="number")
//         *   ),
//         *     @OA\Parameter(
//         *      name="per_page",
//         *      in="query",
//         *      description="Items per page",
//         *      example="10",
//         *     @OA\Schema(type="number")
//         *   ),
//         *      @OA\Parameter(
//         *      name="sort_by",
//         *      in="query",
//         *      description="Sort items by",
//         *      example="updated_at",
//         *     @OA\Schema(type="string")
//         *   ),
//         *      @OA\Parameter(
//         *      name="sort_type",
//         *      in="query",
//         *      description="Sort items type ['asc', 'desc']",
//         *      example="desc",
//         *     @OA\Schema(type="string")
//         *   ),
//         *   @OA\Response(response=200, description="OK"),
//         *   @OA\Response(response=401, description="Unauthorized"),
//         *   @OA\Response(response=404, description="Not Found"),
//         *
//         * )
//         */
//        return $this->RoleRepo->getDeletedList($request);
//    }

    public function store(Request $request)
    {
        /**
         * @OA\Post(
         *   tags={"Role"},
         *   path="/api/role",
         *   summary="Thêm quyền mới",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name", "permission"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="permission", type="[]"),
         *       example={"name": "Tên quyền", "permission": "Nhận mảng[]"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'role' => $request->name,
            'permission' => $request->permission,
        ];
        
        return $this->RoleRepo->storeRolePermission($attributes);
    }

    public function getById($id)
    {
        return $this->RoleRepo->getById_role_pe($id);
    }
//
    public function update(Request $request, $id)
    {
        $attributes = [
            'name' => $request->name,
            'permission' => $request->permission,
        ];

        return $this->RoleRepo->update_role_pe($id, $attributes);
    }
//
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
        return $this->RoleRepo->delete_role_pe($id);
    }
//
//    public function remove($id)
//    {
//        /**
//         * @OA\Delete(
//         *   tags={"Role"},
//         *   path="/api/role/{id}/remove",
//         *   summary="Remove Role from trash",
//         *   @OA\Parameter(
//         *     name="id",
//         *     in="path",
//         *     required=true,
//         *     @OA\Schema(type="string")
//         *   ),
//         *   @OA\Response(response=200, description="OK"),
//         *   @OA\Response(response=401, description="Unauthorized"),
//         *   @OA\Response(response=404, description="Not Found")
//         * )
//         */
//        return $this->RoleRepo->remove($id);
//    }
//
//    public function restore(Role $Role, $id)
//    {
//        /**
//         * @OA\Patch(
//         *   tags={"Role"},
//         *   path="/api/role/{id}/restore",
//         *   summary="Restore Role from trash",
//         *   @OA\Parameter(
//         *     name="id",
//         *     in="path",
//         *     required=true,
//         *     @OA\Schema(type="string")
//         *   ),
//         *   @OA\Response(response=200, description="OK"),
//         *   @OA\Response(response=401, description="Unauthorized"),
//         *   @OA\Response(response=404, description="Not Found")
//         * )
//         */
//        return $this->RoleRepo->restore($id);
//    }
//
//    public function employees($id)
//    {
//        /**
//         * @OA\Get(
//         *   tags={"Role"},
//         *   path="/api/role/{id}/employees",
//         *   summary="List Role",
//         *   @OA\Parameter(
//         *     name="id",
//         *     in="path",
//         *     required=true,
//         *     @OA\Schema(type="string")
//         *   ),
//         *   @OA\Parameter(
//         *      name="search",
//         *      in="query",
//         *      description="Search by",
//         *     @OA\Schema(type="string")
//         *   ),
//         *   @OA\Parameter(
//         *      name="q",
//         *      in="query",
//         *      description="Search query",
//         *     @OA\Schema(type="string")
//         *   ),
//         *     @OA\Parameter(
//         *      name="page",
//         *      in="query",
//         *      description="Page",
//         *      example="1",
//         *     @OA\Schema(type="number")
//         *   ),
//         *     @OA\Parameter(
//         *      name="per_page",
//         *      in="query",
//         *      description="Items per page",
//         *      example="10",
//         *     @OA\Schema(type="number")
//         *   ),
//         *      @OA\Parameter(
//         *      name="sort_by",
//         *      in="query",
//         *      description="Sort items by",
//         *      example="updated_at",
//         *     @OA\Schema(type="string")
//         *   ),
//         *      @OA\Parameter(
//         *      name="sort_type",
//         *      in="query",
//         *      description="Sort items type ['asc', 'desc']",
//         *      example="desc",
//         *     @OA\Schema(type="string")
//         *   ),
//         *   @OA\Response(response=200, description="OK"),
//         *   @OA\Response(response=401, description="Unauthorized"),
//         *   @OA\Response(response=404, description="Not Found"),
//         *
//         * )
//         */
//
//        return $this->RoleRepo->getEmployees($id);
//    }
}
