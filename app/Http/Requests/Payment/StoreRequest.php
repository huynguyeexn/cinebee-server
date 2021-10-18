<?php

namespace App\Http\Requests\Payment;

use App\Models\ComboTicket;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\MovieTicket;
use App\Models\PaymentStatus;
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
    public function rules(PaymentStatus $status, Employee $employee, Customer $customer, ComboTicket $combo_ticket, MovieTicket $movie_ticket)
    {
        $statusId = $status->getTable();
        $employeeId = $employee->getTable();
        $customerId = $customer->getTable();
        $comboTicketId = $combo_ticket->getTable();
        $movieTicketId = $movie_ticket->getTable();
        return [
            'booking_at'        => "required|date",
            'payment_status_id'  => "nullable|integer|exists:$statusId,id",
            'employee_id'         => "nullable|integer|exists:$employeeId,id",
            'customer_id'         => "nullable|integer|exists:$customerId,id",
            'combo_ticket_id'     => "nullable|integer|exists:$comboTicketId,id",
            'movie_ticket_id'     => "nullable|integer|exists:$movieTicketId,id",
        ];

   }
}