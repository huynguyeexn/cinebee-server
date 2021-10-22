<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableComboTicketDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_ticket_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_ticket_id')
            ->nullable()
            ->constrained()
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->integer('quantity');
            $table->float('price');
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
        Schema::dropIfExists('combo_ticket_details');
    }
}
