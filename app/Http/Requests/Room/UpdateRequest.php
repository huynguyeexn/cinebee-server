<?php

namespace App\Http\Requests\Room;

use App\Models\RoomStatus;
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
    public function rules(RoomStatus $roomStatus)
    {
        $roomStatusName = $roomStatus->getTable();
        return [
            //
            'name' => "string|required|unique:rooms,name,$this->id",
            "room_status_id" => "exists:$roomStatusName,id"
        ];
    }
}
