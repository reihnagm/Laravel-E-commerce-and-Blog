<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{

    public function up()
    {

        Schema::create('order_product', function (Blueprint $table) {

            $table->increments('id');
            $table->Unsignedinteger('product_id');
            $table->Unsignedinteger('order_id');
            $table->integer('qty');
            $table->float('total');
            $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade');
            $table->foreign('order_id')->on('orders')->references('id')->onDelete('cascade');
            $table->timestamps();

        });

    }


    public function down()
    {

        Schema::dropIfExists('order_product');

    }

}
