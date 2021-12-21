<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('comment_at');
            $table->text('content');
            $table->integer('like');
            $table->integer('dislike');
            $table->integer('status');
            $table->foreignId('movie_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate();
            $table->foreignId('customer_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('comments');
    }
}
