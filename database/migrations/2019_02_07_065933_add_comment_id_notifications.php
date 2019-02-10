<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentIdNotifications extends Migration
{

    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
        $table->unsignedinteger('comment_id');
        });
    }

    public function down()
    {
        Schema::table('notifcations', function (Blueprint $table) {
                $table->foreign('comment_id')->references('id')->on('blog_comments')->onDelete('cascade');
        });
    }
}
