<?php

namespace Database\Factories;

use App\Models\AgeRating;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $age_rating = AgeRating::inRandomOrder()->first();
        return [
            //
            'name' => $name,
            'slug' => Str::slug($name),
            'trailer' => "https://www.youtube.com/watch?v=dQw4w9WgXcQ",
            'thumbnail' => "https://cdn.filestackcontent.com/Krg875TyRVwr5OOumHAG",
            'likes' => $this->faker->numberBetween(100, 10000),
            'description' => $this->faker->text(500),
            'release_date' => $this->faker->dateTimeThisYear(),
            'running_time' => $this->faker->numberBetween(90, 150),
            'age_rating_id' => $age_rating,
        ];
    }
}
