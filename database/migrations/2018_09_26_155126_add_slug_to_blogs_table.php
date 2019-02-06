<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToBlogsTable extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('slug');
        });
    }


    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
        });
    }
}
