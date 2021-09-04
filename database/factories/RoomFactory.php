<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status_id = RoomStatus::inRandomOrder()->first();
        $name = "Phòng chiếu " . $this->faker->numberBetween(1, 100);
        return [
            //
            'name' => $name,
            'room_status_id' => $status_id
        ];
    }
}
