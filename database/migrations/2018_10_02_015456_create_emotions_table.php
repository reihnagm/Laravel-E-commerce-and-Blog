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
            $table->unsignedinteger('emotion_id');
            $table->unsignedinteger('blog_id');
            $table->unsignedinteger('user_id');

            // $table->foreign('emotion_id')->references('id')->on('emotion_lists')->onDelete('cascade');
            // $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('emotions');
    }
}
