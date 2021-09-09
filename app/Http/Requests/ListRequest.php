<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListRequest extends FormRequest
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
            'q' => 'nullable|string|',
            'page' => 'nullable|numeric',
            'per_page' => 'nullable|numeric|min:0',
            'sort_by' => 'nullable|string',
            'sort_type' => [
                'nullable',
                Rule::in(['asc', 'desc']),
            ],
        ];
    }

    public function passedValidation()
    {
    }
}
