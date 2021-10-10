<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMovieFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_files', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->foreignId('movie_id')
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignId('file_upload_id')
                ->constrained()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_files');
    }
}
