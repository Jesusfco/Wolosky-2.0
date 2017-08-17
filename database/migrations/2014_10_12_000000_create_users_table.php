<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->binary('fingerprint')->nullable();
            $table->string('name');
            $table->string('img');
            $table->date('birthday')->nullable();
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('houseNumber')->nullable();
            $table->string('colony')->nullable();
            $table->string('city')->nullable();
            $table->integer('monthlyPaymentId')->nullable();
            $table->integer('userTypeId');
            $table->integer('salaryId')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
