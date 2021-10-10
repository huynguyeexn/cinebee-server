<?php

namespace App\Http\Requests\Combo;

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
            'name' => "required|string",
            'price' => "required|numeric",
            'slug' => "unique:combos,slug|string|required|regex:/^[a-z0-9-]+$/"
        ];
    }
}
