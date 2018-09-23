<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    
    public function up()
    {

        Schema::create('notifications', function (Blueprint $table) {

          $table->increments('id');
          $table->string('subject', 100);

          $table->integer('user_id')->unsigned();
          $table->integer('blog_id')->unsigned()->nullable();
          $table->integer('like_id')->unsigned()->nullable();
          $table->boolean('seen')->default(false);
          
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        
          $table->timestamps();
        
        });

    }

    public function down()
    {

        Schema::dropIfExists('notifications');
    
    }

}
