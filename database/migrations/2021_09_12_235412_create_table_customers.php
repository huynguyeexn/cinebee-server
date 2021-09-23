<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->startingValue(10000);
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone', 20)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedTinyInteger('gender')->default(0); // 0 Nam, 1 Nữ, 2 Khác
            $table
                ->foreignId("customer_type_id")
                ->nullable()
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
        Schema::dropIfExists('customers');
    }
}
