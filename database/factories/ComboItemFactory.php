<?php

namespace Database\Factories;

use App\Models\Combo;
use App\Models\ComboItem;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComboItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComboItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'combo_id' => Combo::inRandomOrder()->first(),
            'item_id' => Item::pluck('id')->random(),
            'quantity' => $this->faker->randomNumber(1, 10),
        ];
    }
}
