<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname'         => $this->faker->name(),
            'username'         => $this->faker->userName(),
            'password'         => Hash::make('Abc@12345'),
            'phone'            => $this->faker->phoneNumber(),
            'email'            => $this->faker->email(),
            'address'          => $this->faker->address(),
            'birthday'         => $this->faker->date('Y-m-d' , '2000/1/1'),
            'sex'              => array_rand(['male','female']),
            'customer_type_id' => CustomerType::select('id')->inRandomOrder()->first(),
        ];
    }
}
