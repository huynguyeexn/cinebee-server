<?php

namespace App\Http\Requests\Seat;

use App\Models\Room;
use App\Models\SeatStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules(Room $room, SeatStatus $seatStatus)
    {
        $roomName = $room->getTable();
        $seatStatusName = $seatStatus->getTable();
        return [
            //
            "name" => "required|string|max:20",
            "col" => "required|integer|max:255",
            "row" => "required|integer|max:255",
            "room_id" => "required|integer|exists:$roomName,id",
            "seat_status_id" => "required|integer|exists:$seatStatusName,id",
        ];
    }
}
