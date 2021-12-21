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
            RoleSeed::class,
            PermissionSeed::class,
            PermissionRole::class,
            EmployeeSeed::class,

            AgeRatingSeeder::class,
            ActorSeed::class,
            GenreSeed::class,
            DirectorSeed::class,

            ItemSeed::class,

            CategorySeed::class,
            BlogSeed::class,

            CustomerTypeSeed::class,
            CustomerSeed::class,

            PaymentStatusSeed::class,
            PaymentSeed::class
        ]);
    }
}
