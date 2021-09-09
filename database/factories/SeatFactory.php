<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Seat;
use App\Models\SeatStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $room_id = Room::inRandomOrder()->first();
        $seat_status_id = SeatStatus::inRandomOrder()->first();
        return [
            //
            "name" => "Ghế " . $this->faker->numberBetween(1, 50),
            "row" => $this->faker->numberBetween(1, 50),
            "col" => $this->faker->numberBetween(1, 50),
            "room_id" => $room_id,
            "seat_status_id" => $seat_status_id,
        ];
    }
}
