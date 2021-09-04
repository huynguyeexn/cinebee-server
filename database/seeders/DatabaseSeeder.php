<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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
        ]);
    }
}
