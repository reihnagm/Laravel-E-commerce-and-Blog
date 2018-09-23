<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewCountBlogsTable extends Migration
{

    public function up()
    {

        Schema::table('blogs', function (Blueprint $table) {

          $table->integer('view_count')->default(0);

        });

    }


    public function down()
    {

        Schema::table('blogs', function (Blueprint $table) {

            $table->dropColumn('view_count');

        });

    }
}
