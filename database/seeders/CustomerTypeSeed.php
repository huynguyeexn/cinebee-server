<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_types')->insert([
            'name' => 'Vip',
            'code' => 'vip',
        ]);
        DB::table('customer_types')->insert([
            'name' => 'Thường',
            'code' => 'normal',
        ]);
    }
}
