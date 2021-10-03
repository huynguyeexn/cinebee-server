<?php

namespace App\Http\Requests\Customer;

use App\Models\CustomerType;
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
    public function rules(CustomerType $customerType)
    {
        $customerTypeName = $customerType->getTable();
        return [
            'fullname' => "required|string|min:3|max:30",
            'username' => "required|string|min:3|max:30|unique:customers,username",
            'password' => "required|string|min:8|max:30|",
            'phone'    => "nullable|string|unique:customers,phone|regex:/^0[0-9]{9,10}/",
            'email'    => "nullable|email|regex:/^.+@.+$/i|unique:customers,email",
            'address'  => "nullable|string|max:100|",
            'birthday' => "nullable|date",
            'gender'      => "nullable|numeric|min:0|max:2",
            'customer_type_id' => "nullable|exists:$customerTypeName,id",
        ];
    }
}