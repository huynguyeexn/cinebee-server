<?php

namespace Database\Seeders;

use App\Models\Genre;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeed extends Seeder
{
    private $failures = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        try {
            // Genre::factory(50)->create();
            DB::table('genres')->insert([
                'name' => 'Hoạt hình', 'slug' => 'hoat-hinh',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Hài', 'slug' => 'hai',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Hình sự', 'slug' => 'hinh-su',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Khoa học', 'slug' => 'khoa-hoc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Viễn tưởng', 'slug' => 'vien-tuong',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Kinh dị', 'slug' => 'kinh-di',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Lãng mạn', 'slug' => 'lang-man',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Lịch sử', 'slug' => 'lich-su',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Âm nhạc', 'slug' => 'am-nhac',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Phiêu lưu', 'slug' => 'phieu-luu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Tài liệu', 'slug' => 'tai-lieu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'hề hước', 'slug' => 'he-huoc-vcl',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Bí Ẩn', 'slug' => 'bi-an',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Chiến tranh', 'slug' => 'chien-tranh',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Chính kịch', 'slug' => 'chinh-kich',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Gia đình', 'slug' => 'gia-dinh',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Giả tưởng', 'slug' => 'gia-tuong',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Gây cấn', 'slug' => 'gay-can',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::table('genres')->insert([
                'name' => 'Hành động', 'slug' => 'hanh-dong',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
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
