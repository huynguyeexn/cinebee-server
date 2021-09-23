<?php

namespace App\Http\Requests\Employee;

use App\Models\EmployeeRole;
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
    public function rules(EmployeeRole $employeeRole)
    {
        $employeeRoleName = $employeeRole->getTable();
        return [
            'fullname' => "required|string|min:3|max:30",
            'username' => "required|string|min:3|max:30|unique:employees,username,$this->id,id",
            'password' => "required|string|min:8|max:30",
            'phone'    => "required|string|unique:employees,phone,$this->id,id|regex:/^0[0-9]{9,10}/",
            'email'    => "required|email|regex:/^.+@.+$/i|unique:employees,email,$this->id,id",
            'address'  => "required|string|max:100",
            'id_card'  => "required|string|unique:employees,id_card,$this->id,id",
            'birthday' => "required|date",
            'gender'      => "required",
            'employee_role_id' => "exists:$employeeRoleName,id",
        ];
    }
}
