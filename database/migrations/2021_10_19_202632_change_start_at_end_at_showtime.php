<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStartAtEndAtShowtime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('showtimes', function (Blueprint $table) {
            //
            $table->renameColumn('start', 'start');
            $table->renameColumn('end', 'end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('showtimes', function (Blueprint $table) {
            //
            $table->renameColumn('start', 'start');
            $table->renameColumn('end', 'end');
        });
    }
}
