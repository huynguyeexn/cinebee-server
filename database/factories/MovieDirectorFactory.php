<?php

namespace Database\Factories;

use App\Models\Director;
use App\Models\Movie;
use App\Models\MovieDirector;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieDirectorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieDirector::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => Movie::inRandomOrder()->first(),
            'director_id' => Director::inRandomOrder()->first(),
        ];
    }
}
