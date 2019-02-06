<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogcommentsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subject');
            $table->timestamps();

            $table->unsignedinteger('blog_id');
            $table->unsignedinteger('user_id');

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade ');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
}
