<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->char('phone', 20)->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->uuid('id_card')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->char('sex', 10)->default('male')->nullable();
            $table
                ->foreignId("employee_role_id")
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
        Schema::dropIfExists('employees');
    }
}
