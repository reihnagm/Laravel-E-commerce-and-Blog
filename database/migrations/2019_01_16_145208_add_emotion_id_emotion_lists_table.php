<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmotionIdEmotionListsTable extends Migration
{
    public function up()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->foreign('emotion_id')->references('id')->on('emotion_lists')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->dropColumn('emotion_id');
        });
    }
}
