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
            'username' => "required|string|min:3|max:30",
            'password' => "required|string|min:8|max:30",
            'phone'    => "required|numeric||regex:/^0[0-9]{9,10}/",
            'email'    => "required|email|regex:/^.+@.+$/i|",
            'address'  => "required|string|max:100|",
            'id_card'  => "required",
            'birthday' => "required|date",
            'sex'      => "required",
            'employee_role_id' => "exists:$employeeRoleName,id",
        ];
    }
}
