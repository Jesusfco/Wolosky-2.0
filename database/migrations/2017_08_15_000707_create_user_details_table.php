<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('houseNumber')->nullable();
            $table->string('colony')->nullable();
            $table->string('city')->nullable();
            $table->integer('monthlyPaymentId')->nullable();
            $table->integer('userTypeId');
            $table->integer('salaryId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
