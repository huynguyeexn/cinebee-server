<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMovieTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('movie_tickets');
        Schema::create('movie_tickets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('get_at');
            $table->float('price');
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('showtime_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('room_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('seat_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_tickets');
    }
}
