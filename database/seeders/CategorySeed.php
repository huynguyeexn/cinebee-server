<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Đánh giá phim',
            'slug' => "danh-gia-phim",
            'show' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Tin điện ảnh',
            'slug' => "tin-dien-anh",
            'show' => 1
        ]);
        DB::table('categories')->insert([
            'name' => 'Video',
            'slug' => "video",
            'show' => 1
        ]);
    }
}
