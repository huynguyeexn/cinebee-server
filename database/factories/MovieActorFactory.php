<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\MovieActor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieActorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieActor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => Movie::inRandomOrder()->first(),
            'actor_id' => Actor::inRandomOrder()->first(),
        ];
    }
}
