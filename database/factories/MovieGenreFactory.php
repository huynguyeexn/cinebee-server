<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieGenreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieGenre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => Movie::inRandomOrder()->first(),
            'genre_id' => Genre::inRandomOrder()->first(),
        ];
    }
}
