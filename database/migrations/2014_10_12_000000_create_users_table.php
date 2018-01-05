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
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->binary('fingerprint')->nullable();
            $table->string('name')->unique();
            $table->string('img')->nullable();
            $table->string('curp')->nullable();
            $table->date('birthday')->nullable();
            $table->string('placeBirth')->nullable();
            $table->smallInteger('gender');
            $table->string('insurance')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('hauseNumber')->nullable();
            $table->string('colony')->nullable();
            $table->string('city')->nullable()->default('TUXTLA GTZ');
            $table->integer('monthlyPaymentId')->nullable();
            $table->integer('userTypeId');
            $table->integer('salaryId')->nullable();
            $table->integer('status')->default(1);
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
