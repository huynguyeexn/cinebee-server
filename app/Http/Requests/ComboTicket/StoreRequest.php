<?php

namespace App\Http\Requests\ComboTicket;

use App\Models\Combo;
use App\Models\Order;
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
    public function rules(Combo $combo, Order $order)
    {
        $comboId = $combo->getTable();
        $orderId = $order->getTable();
        return [
            "get_at" => "required",
            'quantity' => 'required|integer',
            "price" => "required|numeric",
            "combo_id" => "required|integer|exists:$comboId,id",
            "order_id" => "required|integer|exists:$orderId,id"
        ];
    }
}
