<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInitialUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Old column
            $table->renameColumn('name', 'fullname');
            $table->string('email')->nullable()->change();

            // New column
            $table->string('username')->unique();
            $table->char('phone', 20)->unique()->nullable();
            $table->string('address')->nullable();
            $table->uuid('id_card')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->char('sex', 10)->default('male')->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Old column
            $table->renameColumn('fullname', 'name');
            $table->string('email')->change();

            // New column
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('id_card');
            $table->dropColumn('birthday');
            $table->dropColumn('sex');

            $table->dropSoftDeletes();
        });
    }
}
