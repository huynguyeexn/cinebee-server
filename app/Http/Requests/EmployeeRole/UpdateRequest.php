<?php

namespace App\Http\Requests\EmployeeRole;

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
            'name' => 'string|required',
            'slug' => "string|required|regex:/^[a-z0-9-]+$/|unique:employee_roles,slug,$this->id"
        ];
    }
}
