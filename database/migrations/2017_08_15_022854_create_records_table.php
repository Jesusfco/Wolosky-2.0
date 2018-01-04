<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('checkIn');
            $table->time('checkOut')->nullable();
            $table->integer('workedHours')->nullable();
            $table->integer('extraHours')->nullable();
            $table->integer('user_id');
            $table->dateTime('date');
            $table->string('observation')->nullable();
            $table->integer('status')->default(1);            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('record');
    }
}
