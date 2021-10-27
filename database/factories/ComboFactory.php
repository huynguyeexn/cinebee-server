<?php

namespace Database\Factories;

use App\Models\Combo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComboFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Combo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence($this->faker->numberBetween(1, 5), true);
        return [
            //
            'name' => $name,
            'price' => $this->faker->numberBetween(1500, 6000, true),
            'slug' => str::slug($name),
            'description' => $this->faker->text(500),
        ];
    }
}
