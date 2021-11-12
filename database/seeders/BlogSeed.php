<?php

namespace Database\Seeders;

use App\Models\Blog;
use Faker\Extension\Extension;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\TryCatch;

class BlogSeed extends Seeder
{
    private $failures = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Blog::factory(10)->create();
        } catch (Extension $e) {

            if ($this->failures > 5) {
                print_r("Seeder Error. Failure count for current entity: " . $this->failures);
                return;
            }

            $this->failures++;
            $this->run(); // retry again until the number of failure is greater than 5
        }
    }
}
