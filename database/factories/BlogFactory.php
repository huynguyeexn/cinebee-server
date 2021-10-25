<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'title'          => $name,
            'slug'          => Str::slug($name),
            'summary'       => $this->faker->text(100),
            'date'          => $this->faker->dateTimeThisYear(),
            'views'         => $this->faker->numberBetween(100, 10000),
            'content'       => $this->faker->text(400),
            'show'          => $this->faker->numberBetween(0, 1),
            'category_id' => Category::inRandomOrder()->first(),
            'employee_id'   => Employee::inRandomOrder()->first(),
        ];
    }
}
