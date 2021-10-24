<?php

namespace Database\Factories;

use App\Models\ComboTicket;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\MovieTicket;
use App\Models\Order;
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
        $codeBank = ['NCB', 'Agribank', 'SCB', 'Sacombank', 'MSBANK','NamABank', 'VCB', 'TPBank', 'Dong A', 'BIDV'];
        return [
            'order_id'          => Order::inRandomOrder()->first(),
            'payment_status_id' => PaymentStatus::inRandomOrder()->first(),
            'code_bank'         => $codeBank[$this->faker->randomNumber(1, 10)],
            'code_transaction'   => $this->faker->numberBetween(10000000, 100000000),
            'note'              => '',
        ];
    }
}
