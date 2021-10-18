<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            'name' => 'Đã thanh toán',
        ]);
        DB::table('payment_statuses')->insert([
            'name' => 'Chưa thanh toán',
        ]);
    }
}