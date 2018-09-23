<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsPublishedToBlogsTable extends Migration
{

    public function up()
    {

        Schema::table('blogs', function (Blueprint $table) {
            
            $table->tinyInteger('is_published')->default(0);

        });

    }

    public function down()
    {

        Schema::table('blogs', function (Blueprint $table) {

            $table->dropColumn('is_published');

        });
        
    }

}
