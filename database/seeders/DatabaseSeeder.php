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
            EmployeeSeed::class,
            PermissionSeed::class,
            PermissionRole::class,

            AgeRatingSeeder::class,
            ActorSeed::class,
            GenreSeed::class,
            DirectorSeed::class,

            ItemSeed::class,

            CategorySeed::class,
            BlogSeed::class,

            CustomerTypeSeed::class,
            CustomerSeed::class,
            PermissionRole::class,
            permissionSeed::class,

            PaymentStatusSeed::class,
            PaymentSeed::class,
            CommentSeed::class
        ]);
    }
}