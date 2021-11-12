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

            RoomStatusSeed::class,
            RoomSeeder::class,

            SeatStatusSeed::class,
            SeatSeeder::class,

            AgeRatingSeeder::class,
            ActorSeed::class,
            GenreSeed::class,
            DirectorSeed::class,

            // MovieActorSeed::class,
            // MovieGenreSeed::class,
            // MovieActorSeed::class,

            CustomerTypeSeed::class,
            CustomerSeed::class,
            // ShowtimeSeed::class,
            // MovieTicketSeed::class,
            // MovieDirectorSeed::class,

            ItemSeed::class,


            CategorySeed::class,
            BlogSeed::class,

            PermissionRole::class,
            permissionSeed::class,

            PaymentStatusSeed::class,
            PaymentSeed::class
        ]);
    }
}
