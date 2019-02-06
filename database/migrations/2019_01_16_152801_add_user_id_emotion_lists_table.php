<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdEmotionListsTable extends Migration
{
    public function up()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('emotions', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
