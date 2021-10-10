<?php

namespace App\Http\Requests\ComboItem;

use App\Models\Combo;
use App\Models\Item;
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
    public function rules(Combo $combo, Item $item)
    {
        $comboId = $combo->getTable();
        $itemId = $item->getTable();
        return [
            "combo_id" => "required|integer|exists:$comboId,id",
            "item_id" => "required|integer|exists:$itemId,id",
            "quantity" => "required|numberic"
        ];
    }
}
