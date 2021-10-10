<?php

namespace App\Http\Requests\ComboTicket;

use App\Models\Combo;
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
    public function rules(Combo $combo)
    {
        $comboId = $combo->getTable();
        return [
            "get_at" => "required",
            "price" => "required|numberic",
            "combo_id" => "required|integer|exists:$comboId,id"
        ];
    }
}
