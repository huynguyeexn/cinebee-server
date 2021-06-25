<?php

namespace App\Http\Requests\SeatStatus;

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
    public function rules()
    {
        return [
            'status' => 'string|required',
            'slug' => 'unique:seat_statuses,slug|string|required|regex:/^[a-z0-9-]+$/'
        ];
    }
}
