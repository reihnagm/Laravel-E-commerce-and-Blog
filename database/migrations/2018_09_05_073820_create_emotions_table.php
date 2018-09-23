<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmotionsTable extends Migration
{

    public function up()
    {

        Schema::create('emotions', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('blog_id');
            $table->unsignedInteger('emotion_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('blog_id')->on('blogs')->references('id')->onDelete('cascade');

        });

    }
  
    public function down()
    {
        
        Schema::dropIfExists('emotions');

    }

}
