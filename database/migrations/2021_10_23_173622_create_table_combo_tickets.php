<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComboTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('combo_tickets');
        Schema::create('combo_tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamp('get_at');
            $table->integer('quantity');
            $table->float('price');
            $table->foreignId('combo_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('order_id')
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
        Schema::dropIfExists('combo_tickets');
    }
}
