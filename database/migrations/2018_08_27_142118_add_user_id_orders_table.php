<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdOrdersTable extends Migration
{

    public function up()
    {

        Schema::table('orders', function (Blueprint $table) {
          $table->unsignedInteger('user_id');
          $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });

    }


    public function down()
    {

        Schema::table('orders', function (Blueprint $table) {
          $table->dropColumn('orders');
        });

    }
}
