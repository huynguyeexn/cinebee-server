<?php

namespace App\Http\Requests\Movie;

use App\Models\AgeRating;
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
    public function rules(AgeRating $ageRating)
    {
        $ageRatingId = $ageRating->getTable();
        return [
            //
            'name' => "string|max:100|required",
            'slug' => "string|required",
            'trailer' => "string|nullable",
            'thumbnail' => "string",
            'description' => "string|nullable",
            'release_date' => "date",
            'running_time' => "numeric",
            'age_rating_id' => "required|integer|exists:$ageRatingId,id",
            'status' => "numeric",
        ];
    }
}
