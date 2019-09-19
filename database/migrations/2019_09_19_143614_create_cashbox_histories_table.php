<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashboxHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashbox_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cashbox_id');  
            $table->bigInteger('creator_id');  
            $table->double('amount');
            $table->double('allow');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashbox_histories');
    }
}
