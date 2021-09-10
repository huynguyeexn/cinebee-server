<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $failures = 0;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ItemSeed::class,
            RoomStatusSeed::class,
            SeatStatusSeed::class,
            UserRoleSeed::class,
            UserSeed::class,
            RoomSeeder::class,
            SeatSeeder::class,
            ActorSeed::class,
            GenreSeed::class,
            EmployeeRoleSeed::class
        ]);
    }
}
