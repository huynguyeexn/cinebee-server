<?php

namespace Database\Factories;

use App\Models\MovieTicket;
use App\Models\Order;
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
            'price' => 45000,
            'order_id' => Order::inRandomOrder()->first(),
            'showtime_id' => Showtime::inRandomOrder()->first(),
            'room_id' => Room::inRandomOrder()->first(),
            'seat_id' => Seat::inRandomOrder()->first(),
        ];
    }
}
