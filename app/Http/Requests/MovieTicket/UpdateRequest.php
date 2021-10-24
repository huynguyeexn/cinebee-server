<?php

namespace App\Http\Requests\MovieTicket;

use App\Models\Order;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Showtime $showtime,Room $room, Seat $seat, Order $order)
    {
        $showtimeId = $showtime->getTable();
        $roomId = $room->getTable();
        $seatId = $seat->getTable();
        $orderId = $order->getTable();
        return [
            'get_at'      => "required|date",
            'price'       => "required|string",
            'order_id'    => "required|integer|exists:$orderId,id",
            'showtime_id' => "required|integer|exists:$showtimeId,id",
            'room_id'     => "required|integer|exists:$roomId,id",
            'seat_id'     => "required|integer|exists:$seatId,id",
        ];
    }
}
