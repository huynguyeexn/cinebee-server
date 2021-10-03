<?php

namespace Database\Factories;

use App\Models\MovieTicket;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'get_at' => $this->faker->dateTimeThisYear(),
            'showtime_id' => Showtime::inRandomOrder()->first(),
            'seat_id' => Seat::inRandomOrder()->first(),
            'price' => '45.000',
        ];
    }
}
