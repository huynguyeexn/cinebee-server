<?php

namespace App\Http\Requests\Combo;

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
    public function rules()
    {
        return [
            //
            'name' => 'string|required',
            'price' => "required|numeric",
            'slug' => "string|required|regex:/^[a-z0-9-]+$/|unique:combos,slug,$this->id"
        ];
    }
}
