<?php

namespace App\Http\Requests\MovieTicket;

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
    public function rules(Showtime $showtime,Seat $seat)
    {
        $showtimeId = $showtime->getTable();
        $seatId = $seat->getTable();
        return [
            'get_at' => "required|date",
            'showtime_id' => "required|integer|exists:$showtimeId,id",
            'seat_id' => "required|integer|exists:$seatId,id",
            'price' => "required|string",
        ];
    }
}
