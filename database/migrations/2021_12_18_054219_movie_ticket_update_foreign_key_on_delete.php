<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MovieTicketUpdateForeignKeyOnDelete extends Migration
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
            DB::table('movie_tickets')->truncate();
            if (!Schema::hasColumn('movie_tickets', 'order_id')) {
                $table->foreignId('order_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            }
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
        });
    }
}
