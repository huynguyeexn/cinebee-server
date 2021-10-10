<?php

namespace Database\Factories;

use App\Models\Combo;
use App\Models\ComboTicket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComboTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComboTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = date('01-08-2021 H:i:s');
        $endDate = date('28-09-2021 H:i:s');
        return [
            //
            'get_at' => $this->faker->dateTimeBetween($startDate, $endDate),
            'price' => $this->faker->numberBetween(1500, 6000, true),
            'combo_id' => Combo::inRandomOrder()->first(),
        ];
    }
}
