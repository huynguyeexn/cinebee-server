<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

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
            'id_card'          => $this->faker->uuid(),
            'birthday'         => $this->faker->date('Y-m-d', '2000/1/1'),
            'gender'              => array_rand(['male', 'female']),
            'employee_role_id' => Role::select('id')->inRandomOrder()->first(),
        ];
    }
}
