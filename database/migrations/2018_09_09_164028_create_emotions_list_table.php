<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmotionsListTable extends Migration
{
    
    public function up()
    {
        Schema::create('emotions_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('emotions_list');
    }
}
