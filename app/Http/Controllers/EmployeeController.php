<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Models\Employee;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use Ramsey\Uuid\Nonstandard\Uuid;

class EmployeeController extends Controller
{
    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepo;

    public function __construct(EmployeeRepositoryInterface $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Employee"},
         *   path="/api/employee",
         *   summary="List Employee",
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
        return $this->employeeRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Employee"},
         *   path="/api/employee/deleted",
         *   summary="List Employee Deleted",
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
        return $this->employeeRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Employee"},
         *   path="/api/employee",
         *   summary="Store new Employee",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "fullname", "username", "password", "phone", "email", "address", "id_card", "birthday", "sex", "employee_role_id"},
         *       @OA\Property(property="fullname", type="string"),
         *       @OA\Property(property="username", type="string"),
         *       @OA\Property(property="password", type="string"),
         *       @OA\Property(property="phone",    type="number"),
         *       @OA\Property(property="email",    type="string"),
         *       @OA\Property(property="address",  type="string"),
         *       @OA\Property(property="id_card",  type="uuid"),
         *       @OA\Property(property="birthday", type="date"),
         *       @OA\Property(property="sex", type="string"),
         *       @OA\Property(property="employee_role_id", type="number"),
         *       example={
         *          "fullname": "Leonie Maggio",
         *          "username": "Leonie",
         *          "password": "Leonie123",
         *          "phone": "346.997.2035",
         *          "email": "Leonie@gmail.com",
         *          "address": "77864 Morissette Coves Port Deontae, MT 45009",
         *          "id_card": "1234-1234-1234-1234",
         *          "birthday": "1993-03-26",
         *          "sex": "2",
         *          "employee_role_id": "1",
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
            'password' => $request->password,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
            'id_card'  => Uuid::uuid4(),
            'birthday' => $request->birthday,
            'sex'      => $request->sex,
            'employee_role_id' => $request->employee_role_id,
        ];
        return $this->employeeRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Employee"},
         *   path="/api/employee/{id}",
         *   summary="Get Employee by id",
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
        return $this->employeeRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Employee"},
         *   path="/api/employee/{id}",
         *   summary="Update a Employee",
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
         *       required={ "fullname", "username", "password", "phone", "email", "address", "id_card", "birthday", "sex", "employee_role_id"},
         *       @OA\Property(property="fullname", type="string"),
         *       @OA\Property(property="username", type="string"),
         *       @OA\Property(property="password", type="string"),
         *       @OA\Property(property="phone",    type="number"),
         *       @OA\Property(property="email",    type="string"),
         *       @OA\Property(property="address",  type="string"),
         *       @OA\Property(property="id_card",  type="uuid"),
         *       @OA\Property(property="birthday", type="date"),
         *       @OA\Property(property="sex", type="string"),
         *       @OA\Property(property="employee_role_id", type="number"),
         *        example={
         *          "fullname": "Leonie Maggio",
         *          "username": "Leonie",
         *          "password": "Leonie123",
         *          "phone": "346.997.2035",
         *          "email": "Leonie@gmail.com",
         *          "address": "77864 Morissette Coves Port Deontae, MT 45009",
         *          "id_card": "",
         *          "bithday": "1993-03-26",
         *          "sex": "male",
         *          "employee_role_id": "1",
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
            'password' => $request->password,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
            'id_card'  => $request->id_card,
            'bithday'  => $request->bithday,
            'sex'      => $request->sex,
            'employee_role_id' => $request->employee_role_id,
        ];

        return $this->employeeRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Employee"},
         *   path="/api/employee/{id}/delete",
         *   summary="Delete a Employee",
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
        return $this->employeeRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Employee"},
         *   path="/api/employee/{id}/remove",
         *   summary="Remove Employee from trash",
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
        return $this->employeeRepo->remove($id);
    }

    public function restore(Employee $employee, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"Employee"},
         *   path="/api/employee/{id}/restore",
         *   summary="Restore Employee from trash",
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
        return $this->employeeRepo->restore($id);
    }
}
