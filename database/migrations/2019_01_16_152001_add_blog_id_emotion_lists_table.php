<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlogIdEmotionListsTable extends Migration
{
    public function up()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->dropColumn('blog_id');
        });
    }
}
