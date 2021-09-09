<?php

namespace Database\Seeders;

use App\Models\CinemaStatus;
use Illuminate\Database\Seeder;

class CinemaStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CinemaStatus::factory(50)->create();
    }
}
