<?php

namespace App\Http\Requests\Customer;

use App\Models\CustomerType;
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
    public function rules(CustomerType $customerType)
    {
        $customerTypeName = $customerType->getTable();
        return [
            'fullname' => "required|string|min:3|max:30",
            'username' => "required|string|min:3|max:30|unique:customers,username,$this->id,id",
            'password' => "required|string|min:8|max:30",
            'phone'    => "required|string|unique:customers,phone,$this->id,id|regex:/^0[0-9]{9,10}/",
            'email'    => "required|email|regex:/^.+@.+$/i|unique:customers,email,$this->id,id",
            'address'  => "required|string|max:100",
            'birthday' => "required|date",
            'sex'      => "required",
            'customer_type_id' => "exists:$customerTypeName,id",
        ];
    }
}
