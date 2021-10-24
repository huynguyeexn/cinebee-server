<?php

namespace Database\Factories;

use App\Models\ComboTicketDetail;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\MovieTicket;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => '120000',
            'booking_at' => $this->faker->dateTimeThisYear(),
            'employee_id' => Employee::inRandomOrder()->first(),
            'customer_id' => Customer::inRandomOrder()->first()
        ];
    }
}
