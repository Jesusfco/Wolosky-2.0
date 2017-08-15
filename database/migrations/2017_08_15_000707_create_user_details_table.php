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
            $table->increments('id');
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->integer('phone')->nullable();
            $table->string('street')->nullable();
            $table->integer('hauseNumber')->nullable();
            $table->string('colony')->nullable();
            $table->string('city')->nullable();
            $table->integer('monthlyPaymentId')->nullable(); //
            $table->integer('userTypeId'); //
            $table->integer('salaryId')->nullable(); // esos tres tienen relaciones, son creo que Uno a Uno si man, One To One, es el mismo procedimiento, crearé los modelos y ahorita los rellenamos, va? va pues lo cargo al git  y nos sincronizamos br

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
        Schema::dropIfExists('user_details');
    }
}
