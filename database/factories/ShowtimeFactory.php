<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Room;
use App\Models\Showtime;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowtimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Showtime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'room_id' => Room::inRandomOrder()->first(),
            'movie_id' => Movie::inRandomOrder()->first(),
            'start_at' => $this->faker->dateTimeThisYear(),
            'end_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
