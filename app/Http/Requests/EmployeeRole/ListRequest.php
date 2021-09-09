<?php

namespace App\Http\Requests\EmployeeRole;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'q' => 'string',
            'sort_by' => 'string',
            'sort_type' => [Rule::in(['desc', 'asc'])],
            'page' => 'numeric|min:1',
            'per_page' => 'numeric|min:1|max:100',
        ];
    }
}
