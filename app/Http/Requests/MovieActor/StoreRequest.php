<?php

namespace App\Http\Requests\MovieActor;

use App\Models\Actor;
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
    public function rules(Movie $movie,Actor $actor)
    {
        $movieId = $movie->getTable();
        $actorId = $actor->getTable();
        return [
            'movie_id' => "required|integer|exists:$movieId,id",
            'actor_id' => "required|integer|exists:$actorId,id",
        ];
    }
}
