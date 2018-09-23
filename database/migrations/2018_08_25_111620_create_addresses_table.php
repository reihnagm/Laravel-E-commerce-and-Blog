<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{

    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addressline');
            $table->string('city');
            $table->string('state');
            $table->integer('zip');
            $table->string('phone');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
