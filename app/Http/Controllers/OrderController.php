<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Models\MovieTicket;
use App\Models\Order;
use App\Models\Showtime;
use App\Repositories\Order\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Order"},
         *   path="/api/orders",
         *   summary="List Order",
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
         *      description="Order per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort Order by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort Order type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->orderRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Order"},
         *   path="/api/orders/deleted",
         *   summary="List Order Deleted",
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
         *      description="Order per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort Order by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort Order type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->orderRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Order"},
         *   path="/api/orders",
         *   summary="Store new Order",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "total", "booking_at", "employee_id", "customer_id"},
         *       @OA\Property(property="total", type="float"),
         *       @OA\Property(property="booking_at", type="date"),
         *       @OA\Property(property="employee_id", type="integer"),
         *       @OA\Property(property="customer_id", type="integer"),
         *       example={
         *          "total": "120000",
         *          "booking_at": "2021-10-21 09:30:00",
         *          "employee_id": 1,
         *          "customer_id": 1,
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $id = null;

        DB::transaction(function () use ($request, &$id) {

            $attributes = [
                'seats' => $request->seats,
                'showtime_id' => $request->showtime_id,
                'customer_id' => Auth::user()->id,
                'booking_at' => Carbon::now(),
                'timeout' => Carbon::now()->addMinutes(10),
            ];

            $showtime = Showtime::find($attributes['showtime_id']);
            $attributes['price'] = $showtime->room->price;

            $order = Order::create([
                'total' => $attributes['price'] * count($attributes['seats']),
                'booking_at' => $attributes['booking_at'],
                'customer_id' => $attributes['customer_id'],
                'timeout' => $attributes['timeout'],
                'showtime_id' => $showtime->id,
            ]);

            foreach ($attributes['seats'] as $seat) {
                $seatInfo = $showtime->room->seats()->where('id', $seat)->first();
                $order->movieTickets()->create([
                    'price' => $attributes['price'],
                    'seat_name' => $seatInfo->label,
                    'room_name' => $showtime->room->name,
                    'seat_id' => $seat,
                ]);
            }

            $id = $order->id;
        });

        return response([
            'message' => 'ok',
            'data' => Order::find($id),
        ], 200);

        // return $this->orderRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Order"},
         *   path="/api/orders/{id}",
         *   summary="Get Order by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Order id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */

        // $result = Order::whereNotNull('timeout')->where('timeout', '<', Carbon::now())->where('showtime_id', $id)->pluck('id')->toArray();

        // return response([
        //     'message' => 'ok',
        //     'data' => $result,
        // ], 200);

        return $this->orderRepo->getById($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Order"},
         *   path="/api/orders/{id}",
         *   summary="Update a Order",
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
         *       required={ "total", "booking_at", "employee_id", "customer_id"},
         *       @OA\Property(property="total", type="float"),
         *       @OA\Property(property="booking_at", type="date"),
         *       @OA\Property(property="employee_id", type="integer"),
         *       @OA\Property(property="customer_id", type="integer"),
         *       example={
         *          "total": "120000",
         *          "booking_at": "2021-10-21 09:30:00",
         *          "employee_id": 1,
         *          "customer_id": 1,
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'total' => $request->total,
            'booking_at' => $request->booking_at,
            'employee_id' => $request->employee_id,
            'customer_id' => $request->customer_id,
        ];

        return $this->orderRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Order"},
         *   path="/api/orders/{id}/delete",
         *   summary="Delete a Order",
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
        return $this->orderRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Order"},
         *   path="/api/orders/{id}/remove",
         *   summary="Remove Order from trash",
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
        return $this->orderRepo->remove($id);
    }

    public function restore(Order $Order, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"Order"},
         *   path="/api/orders/{id}/restore",
         *   summary="Restore Order from trash",
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
        return $this->orderRepo->restore($id);
    }

    public function confirm($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Order"},
         *   path="/api/orders/{id}/confirm",
         *   summary="Confirm Order",
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
        // Status
        // 0: Closed
        // 1: Pending
        // 2: Completed
        // 3: Refunded
        // 4: Failed
        $order = Order::findOrFail($id);
        if ($order->status == 1) {
            $order->status = 2;
            $order->timeout =  null;
            $order->verify_code = uniqid("order_code_$order->id", true);
            $order->save();
            return response([
                'message' => 'Thanh toán thành công',
                'data' => $order,
            ], 200);
        } else {
            return response([
                'message' => 'Đơn hàng được thanh toán',
                'data' => $order,
            ], 200);
        }
    }
}
