<?php

namespace Database\Factories;

use App\Models\ComboTicket;
use App\Models\ComboTicketDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComboTicketDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComboTicketDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'combo_ticket_id' => ComboTicket::inRandomOrder()->first(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(99000, 200000, true),
        ];
    }
}