<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepo;

    public function __construct(CustomerRepositoryInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Customers"},
         *   path="/api/customers",
         *   summary="List Customer",
         *   @OA\Parameter(
         *      name="search",
         *      in="query",
         *      description="Search by",
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
        return $this->customerRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Customers"},
         *   path="/api/customers/deleted",
         *   summary="List Customer Deleted",
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
        return $this->customerRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Customers"},
         *   path="/api/customers",
         *   summary="Store new Customer",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "fullname", "username", "password"},
         *       @OA\Property(property="fullname", type="string"),
         *       @OA\Property(property="username", type="string"),
         *       @OA\Property(property="password", type="string"),
         *       @OA\Property(property="phone",    type="number"),
         *       @OA\Property(property="email",    type="string"),
         *       @OA\Property(property="address",  type="string"),
         *       @OA\Property(property="birthday", type="date"),
         *       @OA\Property(property="gender", type="string"),
         *       @OA\Property(property="customer_type_id", type="number"),
         *       example={
         *          "fullname": "Leonie Maggio",
         *          "username": "Leonie",
         *          "password": "Leonie123",
         *          "phone": "346.997.2035",
         *          "email": "Leonie@gmail.com",
         *          "address": "77864 Morissette Coves Port Deontae, MT 45009",
         *          "birthday": "1993-03-26",
         *          "gender": "2",
         *          "customer_type_id": "1",
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
            'birthday'  => \Carbon\Carbon::parse($request->birthday),
            'gender'      => $request->gender,
            'customer_type_id' => $request->customer_type_id,
        ];
        return $this->customerRepo->store($attributes);
    }


    public function register(RegisterRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Customers"},
         *   path="/api/customers",
         *   summary="Store new Customer",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "fullname", "username", "password"},
         *       @OA\Property(property="fullname", type="string"),
         *       @OA\Property(property="username", type="string"),
         *       @OA\Property(property="password", type="string"),
         *       @OA\Property(property="email",    type="string"),
         *       example={
         *          "fullname": "Leonie Maggio",
         *          "username": "Leonie",
         *          "password": "Leonie123",
         *          "email": "Leonie@gmail.com",
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email'    => $request->email,
        ];
        return $this->customerRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Customers"},
         *   path="/api/customers/{id}",
         *   summary="Get Customer by id",
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
        return $this->customerRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Customers"},
         *   path="/api/customers/{id}",
         *   summary="Update a Customer",
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
         *       @OA\Property(property="fullname", type="string"),
         *       @OA\Property(property="username", type="string"),
         *       @OA\Property(property="phone",    type="number"),
         *       @OA\Property(property="email",    type="string"),
         *       @OA\Property(property="address",  type="string"),
         *       @OA\Property(property="birthday", type="date"),
         *       @OA\Property(property="gender", type="string"),
         *       @OA\Property(property="customer_type_id", type="integer"),
         *        example={
         *          "fullname": "Leonie Maggio",
         *          "username": "Leonie",
         *          "password": "Leonie123",
         *          "phone": "346.997.2035",
         *          "email": "Leonie@gmail.com",
         *          "address": "77864 Morissette Coves Port Deontae, MT 45009",
         *          "id_card": "",
         *          "birthday": "1993-03-26",
         *          "gender": "male",
         *          "customer_type_id": "1",
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        // is_null($request->fullname) ?: $attributes['fullname'] = $request->fullname;

        $attributes = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
            'birthday'  => \Carbon\Carbon::parse($request->birthday),
            'gender'      => $request->gender,
            'customer_type_id' => $request->customer_type_id,
        ];

        return $this->customerRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Customers"},
         *   path="/api/customers/{id}/delete",
         *   summary="Delete a Customer",
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
        return $this->customerRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Customers"},
         *   path="/api/customers/{id}/remove",
         *   summary="Remove Customer from trash",
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
        return $this->customerRepo->remove($id);
    }

    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Customers"},
         *   path="/api/customers/{id}/restore",
         *   summary="Restore Customer from trash",
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
        return $this->customerRepo->restore($id);
    }
}
