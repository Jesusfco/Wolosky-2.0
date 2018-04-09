<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_description', function (Blueprint $table) {
            $table->bigIncrements('id');                                                                                
            $table->integer('sale_id');
            $table->integer('product_id');
            $table->string('product_name')->nullable();                   
            $table->integer('quantity');
            $table->double('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_description', function (Blueprint $table) {
            //
        });
    }
}
