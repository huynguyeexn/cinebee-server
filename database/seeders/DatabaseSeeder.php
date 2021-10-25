<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\ShowTime;
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
            EmployeeRoleSeed::class,
            EmployeeSeed::class,
            EmployeeRoleSeed::class,

            UserRoleSeed::class,
            UserSeed::class,

            CustomerTypeSeed::class,
            CustomerSeed::class,

            // RoomStatusSeed::class,
            // RoomSeeder::class,

            SeatStatusSeed::class,
            // SeatSeeder::class,

            AgeRatingSeeder::class,
            // ActorSeed::class,
            GenreSeed::class,
            // DirectorSeed::class,

            // MovieActorSeed::class,
            // MovieGenreSeed::class,
            // MovieDirectorSeed::class,

            ItemSeed::class,
<<<<<<< HEAD
=======

            CategorySeed::class,
            BlogSeed::class,

            PermissionRole::class,
            permissionSeed::class,
>>>>>>> heroku
        ]);
    }
}
