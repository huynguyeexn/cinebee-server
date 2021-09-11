<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // https://vi.wikipedia.org/wiki/Ki%E1%BB%83m_duy%E1%BB%87t_v%C3%A0_ph%C3%A2n_lo%E1%BA%A1i_phim#Hi.E1.BB.87n_nay
        DB::table('age_ratings')->insert([
            'name' => 'P',
            'description' => "Thích hợp cho mọi độ tuổi."
        ]);
        DB::table('age_ratings')->insert([
            'name' => 'C13',
            'description' => "Cấm người dưới 13 tuổi."
        ]);
        DB::table('age_ratings')->insert([
            'name' => 'C16',
            'description' => "Cấm người dưới 16 tuổi."
        ]);
        DB::table('age_ratings')->insert([
            'name' => 'C18',
            'description' => "Cấm người dưới 18 tuổi."
        ]);
    }
}
