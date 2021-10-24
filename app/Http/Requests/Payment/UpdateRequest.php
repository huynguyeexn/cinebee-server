<?php

namespace App\Http\Requests\Payment;

use App\Models\Order;
use App\Models\PaymentStatus;
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
    public function rules(PaymentStatus $status, Order $order)
    {
        $statusId = $status->getTable();
        $orderId = $order->getTable();
        return [
            'order_id'           => "required|integer|exists:$orderId,id",
            'payment_status_id'  => "required|integer|exists:$statusId,id",
            'code_bank'          => "required|string",
            'code_transaction'   => "required|string|unique:payments,code_transaction,$this->id,id",
            'note'               => "nullable|string",
        ];
    }
}
