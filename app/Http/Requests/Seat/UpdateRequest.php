<?php

namespace App\Http\Requests\Seat;

use App\Models\Room;
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
    public function rules(Room $room)
    {
        $roomName = $room->getTable();
        return [
            //
            "name" => "required|string|max:20",
            "col" => "required|integer|max:255",
            "row" => "required|integer|max:255",
            "room_id" => "required|integer|exists:$roomName,id",
            "seat_status_id" => "required|integer",
        ];
    }
}
