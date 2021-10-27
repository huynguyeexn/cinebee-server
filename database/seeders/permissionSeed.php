<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class permissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array1 = ['list','create','edit','update','delete','restore'];
        $actors = 'actors';
        $genres = 'genres';
        $seat_status = 'seat-status';
        $room_status = 'room-status';
        $items = 'items';
        $rooms = 'rooms';
        $seats = 'seats';
        $employee_roles = 'employee-roles';
        $directors = 'directors';
        $employee = 'employee';
        $age_ratings = 'age-ratings';
        $movies = 'movies';
        $movie_directors = 'movie-directors';
        $movie_genres = 'movie-genres';
        $movie_actors = 'movie-actors';
        $customer_types = 'customer-types';
        $customers = 'customers';
        $array2 = [$actors,$genres,$seat_status,
        $room_status,$items,$rooms,$seats,$employee_roles,
        $employee,$directors,$age_ratings,$movies,$movie_directors,
        $movie_actors,$movie_genres,$customer_types,$customers];
        $display_name = "";
        foreach($array2 as $ar2){
            foreach($array1 as $val){
               $name = $val.'-'.$ar2;
               $count = DB::table('permissions')->where('name',$name)->count();
                if($count == 0){
                    if($val == "list"):
                        $display_name = "Danh sách";
                    elseif($val == 'create'):
                        $display_name = "Thêm";
                    elseif($val == 'edit'):
                        $display_name = "Sửa";
                    elseif($val == 'update'):
                        $display_name = "Cập nhật";
                    elseif($val == 'delete'):
                        $display_name = "Xóa";
                    elseif($val == 'restore'):
                        $display_name = "Khôi phục";
                    endif;
                    DB::table('permissions')->insert([
                        'name'=>  $name,
                        'display_name'=> $display_name ." ". $ar2
                    ]);
                }
            }
        }
    }
}
