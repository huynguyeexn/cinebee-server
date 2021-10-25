<?php

namespace App\Http\Requests\Showtime;

use App\Models\Movie;
use App\Models\Room;
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
    public function rules(Movie $movie,Room $room)
    {
        $movieId = $movie->getTable();
        $roomId = $room->getTable();
        return [
            'room_id' => "required|integer|exists:$roomId,id",
            'movie_id' => "required|integer|exists:$movieId,id",
            'start_at' => "required|date",
            'end_at' => "required|date",
        ];
    }
}
