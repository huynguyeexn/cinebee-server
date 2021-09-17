<?php

namespace App\Http\Requests\MovieGenre;

use App\Models\Genre;
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
    public function rules(Movie $movie,Genre $genre)
    {
        $movieId = $movie->getTable();
        $genreId = $genre->getTable();
        return [
            'movie_id' => "required|integer|exists:$movieId,id",
            'genre_id' => "required|integer|exists:$genreId,id",
        ];
    }
}
