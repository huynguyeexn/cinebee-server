<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name_slug = $this->faker->sentence($this->faker->numberBetween(1, 5), true);
        $id = rand(0, 3000);
        return [
            'fullname' => $name_slug,
            'slug' => Str::slug($name_slug),
            'avatar' => "https://picsum.photos/200/300?random=$id",
        ];
    }
}