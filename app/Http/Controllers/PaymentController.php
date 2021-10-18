<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Payment\StoreRequest;
use App\Http\Requests\Payment\UpdateRequest;
use App\Models\Payment;
use App\Repositories\Payment\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @var PaymentRepositoryInterface
     */
    protected $paymentRepo;

    public function __construct(PaymentRepositoryInterface $paymentRepo)
    {
        $this->paymentRepo = $paymentRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Payment"},
         *   path="/api/payments",
         *   summary="List Payment",
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
         *      description="Payment per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort payment by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort payment type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->paymentRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Payment"},
         *   path="/api/payments/deleted",
         *   summary="List Payment Deleted",
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
         *      description="Payment per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort payment by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort payment type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->paymentRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Payment"},
         *   path="/api/payments",
         *   summary="Store new Payment",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "booking_at", "payment_status_id", "employee_id", "customer_id", "combo_ticket_id", "movie_ticket_id"},
         *       @OA\Property(property="booking_at", type="date"),
         *       @OA\Property(property="payment_status_id", type="integer"),
         *       @OA\Property(property="employee_id", type="integer"),
         *       @OA\Property(property="customer_id", type="integer"),
         *       @OA\Property(property="combo_ticket_id", type="integer"),
         *       @OA\Property(property="movie_ticket_id", type="integer"),
         *       example={
         *          "booking_at": "2021-10-17 10:41:00",
         *          "payment_status_id": 1,
         *          "employee_id": 1,
         *          "customer_id": 1,
         *          "combo_ticket_id": 1,
         *          "movie_ticket_id": 1,
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'booking_at' => $request->booking_at,
            'payment_status_id' => $request->payment_status_id,
            'employee_id' => $request->employee_id,
            'customer_id' => $request->customer_id,
            'combo_ticket_id' => $request->combo_ticket_id,
            'movie_ticket_id' => $request->movie_ticket_id,
        ];
        return $this->paymentRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Payment"},
         *   path="/api/payments/{id}",
         *   summary="Get Payment by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Payment id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->paymentRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Payment"},
         *   path="/api/payments/{id}",
         *   summary="Update a Payment",
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
         *       required={ "booking_at", "payment_status_id", "employee_id", "customer_id", "combo_ticket_id", "movie_ticket_id"},
         *       @OA\Property(property="booking_at", type="date"),
         *       @OA\Property(property="payment_status_id", type="integer"),
         *       @OA\Property(property="employee_id", type="integer"),
         *       @OA\Property(property="customer_id", type="integer"),
         *       @OA\Property(property="combo_ticket_id", type="integer"),
         *       @OA\Property(property="movie_ticket_id", type="integer"),
         *       example={
         *          "booking_at": "2021-10-17 10:41:00",
         *          "payment_status_id": 1,
         *          "employee_id": 1,
         *          "customer_id": 1,
         *          "combo_ticket_id": 1,
         *          "movie_ticket_id": 1,
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'booking_at' => $request->booking_at,
            'payment_status_id' => $request->payment_status_id,
            'employee_id' => $request->employee_id,
            'customer_id' => $request->customer_id,
            'combo_ticket_id' => $request->combo_ticket_id,
            'movie_ticket_id' => $request->movie_ticket_id,
        ];

        return $this->paymentRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Payment"},
         *   path="/api/payments/{id}/delete",
         *   summary="Delete a Payment",
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
        return $this->paymentRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Payment"},
         *   path="/api/payments/{id}/remove",
         *   summary="Remove Payment from trash",
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
        return $this->paymentRepo->remove($id);
    }

    public function restore(Payment $payment, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"Payment"},
         *   path="/api/payments/{id}/restore",
         *   summary="Restore Payment from trash",
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
        return $this->paymentRepo->restore($id);
    }
}