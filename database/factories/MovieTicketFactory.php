<?php

namespace Database\Factories;

use App\Models\MovieTicket;
use App\Models\Room;
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
        $alphabet = ['A','B','C','D','E','F','G','H','I','G','K','L','M','N','O'];
        return [
            'get_at' => $this->faker->dateTimeThisYear(),
            'showtime_id' => Showtime::inRandomOrder()->first(),
            'room_id' => Room::inRandomOrder()->first(),
            'seat_code' => $this->faker->randomNumber(1, 10),
            'seat_text' => $alphabet[$this->faker->randomNumber(1, 10)].$this->faker->randomNumber(1, 10),
            'price' => 45000,
        ];
    }
}