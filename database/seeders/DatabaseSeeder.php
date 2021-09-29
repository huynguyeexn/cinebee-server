<?php

namespace Database\Seeders;

use App\Models\Movie;
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
            EmployeeRoleSeed::class,
            EmployeeSeed::class,
            MovieSeeder::class,
            ActorSeed::class,
            GenreSeed::class,
            EmployeeRoleSeed::class,
            DirectorSeed::class,
            AgeRatingSeeder::class,
            MovieDirectorSeed::class,
            MovieGenreSeed::class,
            MovieActorSeed::class,
            CustomerTypeSeed::class,
            CustomerSeed::class,
        ]);
    }
}
