<?php

namespace Database\Factories;

use App\Models\SeatStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SeatStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SeatStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->sentence($this->faker->numberBetween(1, 5), true);
        return [
            'name' => $status,
            'slug' => Str::slug($status),
        ];
    }
}
