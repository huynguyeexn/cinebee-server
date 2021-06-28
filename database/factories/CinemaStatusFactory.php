<?php

namespace Database\Factories;

use App\Models\CinemaStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CinemaStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CinemaStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name_slug = $this->faker->sentence($this->faker->numberBetween(1, 5), true);
        return [
            'name' => $name_slug,
            'slug' => Str::slug($name_slug)
        ];
    }
}
