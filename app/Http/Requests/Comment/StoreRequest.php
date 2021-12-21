<?php

namespace App\Http\Requests\Comment;

use App\Models\Customer;
use App\Models\Movie;
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
    public function rules(Customer $customer, Movie $movie)
    {
        $customerId = $customer->getTable();
        $movieId = $movie->getTable();
        return [
            'comment_at' => "required|date",
            'content' => "required|string",
            'like' => "integer",
            'dislike'    => "integer",
            'status'    => "integer",
            'customer_id' => "integer|exists:$customerId,id|nullable",
            'movie_id' => "integer|exists:$movieId,id|nullable",
        ];
    }
}
