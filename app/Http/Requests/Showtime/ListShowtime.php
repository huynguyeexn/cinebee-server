<?php

namespace App\Http\Requests\Showtime;

use App\Models\Movie;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;

class ListShowtime extends FormRequest
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
    public function rules()
    {
        return [
            'date' => 'required|date_format:Y-m-d\TH:i:sP',
        ];
    }
}
