<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmotionListsTable extends Migration
{
    public function up()
    {
        Schema::create('emotion_lists', function (Blueprint $table) {
            $table->increments('id')->unsignedInteger();
            $table->string('name');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('emotion_lists');
    }
}
