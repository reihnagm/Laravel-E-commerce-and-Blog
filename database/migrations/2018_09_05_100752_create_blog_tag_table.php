<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTagTable extends Migration
{
    public function up()
    {
        Schema::create('blog_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('blog_id');
            $table->unsignedInteger('tag_id');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_tag');
    }
}
