<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagIdBlogsTable extends Migration
{

    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
          $table->dropColumn('tag_id');
        });
    }

}
