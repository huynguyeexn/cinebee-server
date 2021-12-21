<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMovieTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movie_tickets', function (Blueprint $table) {
            //
            $table->dateTime('get_at')->nullable()->change();
            $table->dropColumn('room_id');
            $table->dropColumn('showtime_id');
            $table->string('room_name');
            $table->string('seat_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movie_tickets', function (Blueprint $table) {
            //
            $table->dateTime('get_at')->nullable(false)->change();
            $table->dropColumn('room_name');
            $table->dropColumn('seat_name');
            $table->foreignId('room_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('showtime_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }
}
