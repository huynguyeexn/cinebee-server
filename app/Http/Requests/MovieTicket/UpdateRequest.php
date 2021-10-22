<?php

namespace App\Http\Requests\MovieTicket;

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
    public function rules(Showtime $showtime,Room $room)
    {
        $showtimeId = $showtime->getTable();
        $roomId = $room->getTable();
        return [
            'get_at'      => "required|date",
            'showtime_id' => "required|integer|exists:$showtimeId,id",
            'room_id'     => "required|integer|exists:$roomId,id",
            'seat_code'   => "required|integer",
            'seat_text'   => "required|string|min:2|max:3",
            'price'       => "required|string",
        ];
    }
}
