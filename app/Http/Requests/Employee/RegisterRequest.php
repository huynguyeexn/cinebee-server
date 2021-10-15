<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fullname' => "required|string|min:3|max:30",
            'username' => "required|string|min:3|max:30|unique:employees,username",
            'password' => "required|string|min:8|max:30|",
            'email'    => "required|email|regex:/^.+@.+$/i|unique:employees,email",
            'address' => "required|string|min:3",
            'sex' => "required|string|min:3",
            'employee_role_id' => "required|integer|in:1,2"
        ];
    }
}
