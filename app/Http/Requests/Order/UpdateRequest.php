<?php

namespace App\Http\Requests\Order;

use App\Models\Customer;
use App\Models\Employee;
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
    public function rules(Employee $employee,Customer $customer)
    {
        $employeeId = $employee->getTable();
        $customerId = $customer->getTable();
        return [
            'total'                   => "required|integer",
            'booking_at'              => "required|date",
            'employee_id'             => "required|integer|exists:$employeeId,id",
            'customer_id'             => "required|integer|exists:$customerId,id",
        ];
    }
}
