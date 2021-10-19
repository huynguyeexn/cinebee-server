<?php

namespace Database\Seeders;

use App\Models\Director;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirectorSeed extends Seeder
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
            $directors = array(
                0 =>
                array(
                    'fullname' => 'Steven Spielberg',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTY1NjAzNzE1MV5BMl5BanBnXkFtZTYwNTk0ODc0._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                1 =>
                array(
                    'fullname' => 'Alfred Hitchcock',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTQxOTg3ODc2NV5BMl5BanBnXkFtZTYwNTg0NTU2._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                2 =>
                array(
                    'fullname' => 'Martin Scorsese',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTcyNDA4Nzk3N15BMl5BanBnXkFtZTcwNDYzMjMxMw@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                3 =>
                array(
                    'fullname' => 'Christopher Nolan',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BNjE3NDQyOTYyMV5BMl5BanBnXkFtZTcwODcyODU2Mw@@._V1_UY209_CR5,0,140,209_AL_.jpg',
                ),
                4 =>
                array(
                    'fullname' => 'James Cameron',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMjI0MjMzOTg2MF5BMl5BanBnXkFtZTcwMTM3NjQxMw@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                5 =>
                array(
                    'fullname' => 'Francis Ford Coppola',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTM5NDU3OTgyNV5BMl5BanBnXkFtZTcwMzQxODA0NA@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                6 =>
                array(
                    'fullname' => 'Quentin Tarantino',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTgyMjI3ODA3Nl5BMl5BanBnXkFtZTcwNzY2MDYxOQ@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                7 =>
                array(
                    'fullname' => 'Guy Ritchie',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTM2NDkxMTcxMl5BMl5BanBnXkFtZTcwNTMyNjI5MQ@@._V1_UY209_CR6,0,140,209_AL_.jpg',
                ),
                8 =>
                array(
                    'fullname' => 'David Fincher',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTc1NDkwMTQ2MF5BMl5BanBnXkFtZTcwMzY0ODkyMg@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                9 =>
                array(
                    'fullname' => 'George Lucas',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTA0Mjc0NzExNzBeQTJeQWpwZ15BbWU3MDEzMzQ3MDI@._V1_UY209_CR1,0,140,209_AL_.jpg',
                ),
                10 =>
                array(
                    'fullname' => 'Stanley Kubrick',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTIwMzAwMzg1MV5BMl5BanBnXkFtZTYwMjc4ODQ2._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                11 =>
                array(
                    'fullname' => 'Peter Jackson',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTY1MzQ3NjA2OV5BMl5BanBnXkFtZTcwNTExOTA5OA@@._V1_UY209_CR6,0,140,209_AL_.jpg',
                ),
                12 =>
                array(
                    'fullname' => 'Clint Eastwood',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTg3MDc0MjY0OV5BMl5BanBnXkFtZTcwNzU1MDAxOA@@._V1_UY209_CR7,0,140,209_AL_.jpg',
                ),
                13 =>
                array(
                    'fullname' => 'Ridley Scott',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMGJkOGM5OWEtNDYxMy00Njg4LWExNjAtY2ZlNWNlNzVhNDk4XkEyXkFqcGdeQXVyNDkzNTM2ODg@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                14 =>
                array(
                    'fullname' => 'Tim Burton',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BOGJmZDUwMzktYmY2MS00M2IwLWIyNmQtYjJhYjc4NjIyZWM1XkEyXkFqcGdeQXVyMTE1MTYxNDAw._V1_UY209_CR0,0,140,209_AL_.jpg',
                ),
                15 =>
                array(
                    'fullname' => 'Danny Boyle',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTc2NTU0ODQ0M15BMl5BanBnXkFtZTcwNjYzMzc5Mg@@._V1_UY209_CR7,0,140,209_AL_.jpg',
                ),
                16 =>
                array(
                    'fullname' => 'Joel Coen',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTg3MjgwMzUzOF5BMl5BanBnXkFtZTcwODM5Nzk4MQ@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                17 =>
                array(
                    'fullname' => 'Lee Unkrich',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMjA1ODE2NTEzN15BMl5BanBnXkFtZTYwNzUzODY2._V1_UY209_CR4,0,140,209_AL_.jpg',
                ),
                18 =>
                array(
                    'fullname' => 'Frank Darabont',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BNjk0MTkxNzQwOF5BMl5BanBnXkFtZTcwODM5OTMwNA@@._V1_UY209_CR14,0,140,209_AL_.jpg',
                ),
                19 =>
                array(
                    'fullname' => 'Robert Zemeckis',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTgyMTMzMDUyNl5BMl5BanBnXkFtZTcwODA0ODMyMw@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                20 =>
                array(
                    'fullname' => 'Woody Allen',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTI1MjU3MTI2MF5BMl5BanBnXkFtZTcwMDgxNTE4MQ@@._V1_UY209_CR1,0,140,209_AL_.jpg',
                ),
                21 =>
                array(
                    'fullname' => 'Alfonso Cuarón',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMjA0ODY4OTk4Nl5BMl5BanBnXkFtZTcwNTkxMzYyMg@@._V1_UX140_CR0,0,140,209_AL_.jpg',
                ),
                22 =>
                array(
                    'fullname' => 'M. Night Shyamalan',
                    'avatar_url' => 'https://m.media-amazon.com/images/M/MV5BMTczMTA5OTMxMl5BMl5BanBnXkFtZTcwMDA4NDg1Mw@@._V1_UY209_CR87,0,140,209_AL_.jpg',
                ),
            );

            foreach ($directors as $d) {
                DB::table('directors')->insert([
                    'fullname' => $d['fullname'],
                    'avatar' => $d['avatar_url'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'slug' => Str::slug($d['fullname']),
                ]);
            }
        } catch (Exception $e) {

            if ($this->failures > 5) {
                print_r("Seeder Error. Failure count for current entity: " . $this->failures);
                return;
            }

            $this->failures++;
            $this->run(); // retry again until the number of failure is greater than 5
        }
    }
}
