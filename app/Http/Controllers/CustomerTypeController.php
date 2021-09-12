<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerType\StoreRequest;
use App\Http\Requests\CustomerType\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Repositories\CustomerType\CustomerTypeRepositoryInterface;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    /**
     * @var CustomerTypeRepositoryInterface
     */
    protected $customerTypeRepo;

    public function __construct(CustomerTypeRepositoryInterface $customerTypeRepo)
    {
        $this->customerTypeRepo = $customerTypeRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Customer Type"},
         *   path="/api/customer-types",
         *   summary="List Customer Type",
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
        return $this->customerTypeRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Customer Type"},
         *   path="/api/customer-types/deleted",
         *   summary="List Customer Type Deleted",
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
        return $this->customerTypeRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Customer Type"},
         *   path="/api/customer-types",
         *   summary="Store new Customer Type",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name"},
         *       @OA\Property(property="name", type="string"),
         *       example={"name": "Khách Hàng"}
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
        return $this->customerTypeRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Customer Type"},
         *   path="/api/customer-types/{id}",
         *   summary="Get Customer Type by id",
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
        return $this->customerTypeRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Customer Type"},
         *   path="/api/customer-types/{id}",
         *   summary="Update a Customer Type",
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
         *       example={"name": "Khách Hàng"}
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

        return $this->customerTypeRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Customer Type"},
         *   path="/api/customer-types/{id}/delete",
         *   summary="Delete a Customer Type",
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
        return $this->customerTypeRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Customer Type"},
         *   path="/api/customer-types/{id}/remove",
         *   summary="Remove Customer Type from trash",
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
        return $this->customerTypeRepo->remove($id);
    }

    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Customer Type"},
         *   path="/api/customer-types/{id}/restore",
         *   summary="Restore Customer Type from trash",
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
        return $this->customerTypeRepo->restore($id);
    }

    public function customers($id)
    {
        /**
         * @OA\Get(
         *   tags={"Customer Type"},
         *   path="/api/customer-types",
         *   summary="List Customer Type",
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

        return $this->customerTypeRepo->getCustomers($id);
    }
}
