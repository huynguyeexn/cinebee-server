<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\StoreRequest;
use App\Http\Requests\Payment\UpdateRequest;
use App\Models\Payment;
use App\Repositories\Payment\PaymentRepositoryInterface;

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
         *       required={ "order_id", "payment_status_id", "code_bank", "code_transaction", "note"},
         *       @OA\Property(property="order_id", type="integer"),
         *       @OA\Property(property="payment_status_id", type="integer"),
         *       @OA\Property(property="code_bank", type="string"),
         *       @OA\Property(property="code_transaction", type="string"),
         *       @OA\Property(property="note", type="string"),
         *       example={
         *          "order_id": 30,
         *          "payment_status_id": 1,
         *          "code_bank": "TPBank",
         *          "code_transaction": "13482203",
         *          "note": "Nội dung thanh toán",
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $code_transaction = strtoupper(substr(md5($request->order_id),8));
        $attributes = [
            'order_id' => $request->order_id,
            'payment_status_id' => $request->payment_status_id,
            'code_bank' => $request->code_bank,
            'code_transaction' => $code_transaction,
            'note' => $request->note,
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
         *       required={ "order_id", "payment_status_id", "code_bank", "code_transaction", "note"},
         *       @OA\Property(property="order_id", type="integer"),
         *       @OA\Property(property="payment_status_id", type="integer"),
         *       @OA\Property(property="code_bank", type="string"),
         *       @OA\Property(property="code_transaction", type="string"),
         *       @OA\Property(property="note", type="string"),
         *       example={
         *          "order_id": 30,
         *          "payment_status_id": 1,
         *          "code_bank": "TPBank",
         *          "code_transaction": "13482203",
         *          "note": "Nội dung thanh toán",
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'order_id' => $request->order_id,
            'payment_status_id' => $request->payment_status_id,
            'code_bank' => $request->code_bank,
            'code_transaction' => $request->code_transaction,
            'note' => $request->note,
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

    public function createPayment(StorePaymentRequest $request)
    {
        /**
         * @OA\Patch(
         *   tags={"Payment"},
         *   path="/api/payments/online",
         *   summary="Create Payment",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "order_type", "amount", "order_desc", "bank_code", "language"},
         *       @OA\Property(property="order_type", type="string"),
         *       @OA\Property(property="amount", type="integer"),
         *       @OA\Property(property="order_desc", type="string"),
         *       @OA\Property(property="bank_code", type="string"),
         *       @OA\Property(property="language", type="string"),
         *       example={
         *          "order_type": "billpayment",
         *          "amount": 100000,
         *          "order_desc": "Nội dung thanh toán",
         *          "bank_code": "TPBank",
         *          "language": "vn",
         *       }
         *     )
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */

        $attributes = [
            'order_type' => $request->order_type,
            'amount'     => $request->amount,
            'order_desc' => $request->order_desc,
            'bank_code'  => $request->bank_code,
            'language'   => $request->language,
        ];

        return $this->paymentRepo->createPayment($attributes);
    }
}
