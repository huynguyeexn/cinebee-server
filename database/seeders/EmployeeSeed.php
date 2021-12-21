<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeed extends Seeder
{
    private $failures = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        try {
            Employee::factory(10)->create();

            \DB::table('employees')->insert([
                'fullname'         => $faker->name(),
                'username'         => "staff",
                'password'         => Hash::make('Abc@12345'),
                'phone'            => $faker->phoneNumber(),
                'email'            => $faker->email(),
                'address'          => $faker->address(),
                'id_card'          => $faker->uuid(),
                'birthday'         => $faker->date('Y-m-d', '2000/1/1'),
                'gender'              => array_rand(['male', 'female']),
                'employee_role_id' => 1,
            ]);
            \DB::table('employees')->insert([
                'fullname'         => $faker->name(),
                'username'         => "manager",
                'password'         => Hash::make('Abc@12345'),
                'phone'            => $faker->phoneNumber(),
                'email'            => $faker->email(),
                'address'          => $faker->address(),
                'id_card'          => $faker->uuid(),
                'birthday'         => $faker->date('Y-m-d', '2000/1/1'),
                'gender'              => array_rand(['male', 'female']),
                'employee_role_id' => 2,
            ]);
            \DB::table('employees')->insert([
                'fullname'         => $faker->name(),
                'username'         => "super_idol",
                'password'         => Hash::make('Abc@12345'),
                'phone'            => $faker->phoneNumber(),
                'email'            => $faker->email(),
                'address'          => $faker->address(),
                'id_card'          => $faker->uuid(),
                'birthday'         => $faker->date('Y-m-d', '2000/1/1'),
                'gender'              => array_rand(['male', 'female']),
                'employee_role_id' => 3,
            ]);

        } catch (Exception $e) {

            if ($this->failures > 5) {
                print_r("Seeder Error. Failure count for current entity: " . $this->failures);
                return;
            }

            $this->failures++;
            $this->run(); // retry again until the number of failure is greater than 5
        }
    }
}
