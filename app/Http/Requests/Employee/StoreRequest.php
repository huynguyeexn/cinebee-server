<?php

namespace App\Http\Requests\Employee;

use App\Models\Role;
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
    public function rules(Role $role)
    {
        $roleName = $role->getTable();
        return [
            'fullname' => "required|string|min:3|max:30",
            'username' => "required|string|min:3|max:30|unique:employees,username",
            'password' => "required|string|min:8|max:30|",
            'phone'    => "required|string|unique:employees,phone|regex:/^0[0-9]{9,10}/",
            'email'    => "nullable|email|regex:/^.+@.+$/i|unique:employees,email",
            'address'  => "nullable|string|max:100|",
            'birthday' => "required|date",
            'gender'      => "required",
            'employee_role_id' => "exists:$roleName,id",
        ];
    }
}
