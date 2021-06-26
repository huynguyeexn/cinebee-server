<?php

namespace Database\Seeders;

use App\Models\SeatStatus;
use Illuminate\Database\Seeder;

class SeatStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SeatStatus::factory(50)->create();
    }
}
