<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {

        Schema::create('orders', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('total');
            $table->TinyInteger('delivered');
            $table->timestamps();

        });

    }

    public function down()
    {

        Schema::dropIfExists('orders');

    }

}
