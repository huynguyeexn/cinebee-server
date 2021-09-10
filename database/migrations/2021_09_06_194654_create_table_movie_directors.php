<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMovieDirectors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_directors', function (Blueprint $table) {
            $table->foreignId('movie_id')
            ->constrained('movie')
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->foreignId('director_id')
            ->constrained('director')
            ->cascadeOnUpdate()
            ->nullOnDelete();
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
        Schema::dropIfExists('movie_directors');
    }
}
