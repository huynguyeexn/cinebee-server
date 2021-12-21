<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Customer;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_at' => $this->faker->dateTimeThisYear(),
            'content' => $this->faker->text(500),
            'like' => $this->faker->numberBetween(10, 100, true),
            'dislike' => $this->faker->numberBetween(10, 100, true),
            'status'  => array_rand([0, 1, 2]),
            'customer_id' => Customer::inRandomOrder()->first(),
            'movie_id' => Movie::inRandomOrder()->first()
        ];
    }
}