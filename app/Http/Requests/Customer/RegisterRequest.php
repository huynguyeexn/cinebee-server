<?php

namespace App\Http\Requests\Customer;

use App\Models\CustomerType;
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
    public function rules(CustomerType $customerType)
    {
        return [
            'fullname' => "required|string|min:3|max:30",
            'username' => "required|string|min:3|max:30|unique:customers,username",
            'password' => "required|string|min:8|max:30|",
            'email'    => "required|nullable|email|regex:/^.+@.+$/i|unique:customers,email",
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'Tên tài khoản đã tồn tại',
            'email.unique' => 'Email đã tồn tại',
        ];
    }
}
