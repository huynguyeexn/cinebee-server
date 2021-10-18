<?php

namespace Database\Factories;

use App\Models\ComboTicket;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\MovieTicket;
use App\Models\Payment;
use App\Models\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_at' => $this->faker->dateTimeThisYear(),
            'payment_status_id' => PaymentStatus::inRandomOrder()->first(),
            'employee_id' => Employee::inRandomOrder()->first(),
            'customer_id' => Customer::inRandomOrder()->first(),
            'combo_ticket_id' => ComboTicket::inRandomOrder()->first(),
            'movie_ticket_id' => MovieTicket::inRandomOrder()->first(),
        ];
    }
}