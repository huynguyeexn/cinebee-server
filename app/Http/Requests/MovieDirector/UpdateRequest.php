<?php

namespace App\Http\Requests\MovieDirector;

use App\Models\Director;
use App\Models\Movie;
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
    public function rules(Movie $movie,Director $director)
    {
        $movieId = $movie->getTable();
        $directorId = $director->getTable();
        return [
            'movie_id' => "required|integer|exists:$movieId,id",
            'director_id' => "required|integer|exists:$directorId,id",
        ];
    }
}
