<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId("role_id")
            ->references('id')->on('employee_roles')
            ->nullable()
            ->cascadeOnUpdate()
            ->nullOnDelete();
            $table->foreignId("permission_id")
            ->references('id')->on('permissions')
            ->nullable()
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
        Schema::table('permission', function (Blueprint $table) {
            //
        });
    }
}
