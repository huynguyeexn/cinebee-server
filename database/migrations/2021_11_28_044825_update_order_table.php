<?php

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Status
            // 0: Closed
            // 1: Pending
            // 2: Confirmed
            // 3: Completed
            // 4: Refunded
            // 5: Failed
            // 6: Expired
            $table->unsignedTinyInteger('status')->default(1);

            // Timeout: in minutes
            $table->dateTime('timeout')->nullable();

            $table->foreignId('showtime_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->dropColumn('timeout');
            $table->dropForeign(['showtime_id']);
        });
    }
}
