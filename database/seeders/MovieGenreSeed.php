<?php

namespace Database\Seeders;

use App\Models\MovieGenre;
use Illuminate\Database\Seeder;
use Exception;

class MovieGenreSeed extends Seeder
{
    private $failures = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            MovieGenre::factory(20)->create();
        // try {
        // } catch (Exception $e) {
        //     if ($this->failures > 5) {
        //         print_r("Seeder Error. Failure count for current entity: " . $this->failures);
        //         return;
        //     }

        //     $this->failures++;
        //     $this->run(); // retry again until the number of failure is greater than 5
        // }
    }
}
