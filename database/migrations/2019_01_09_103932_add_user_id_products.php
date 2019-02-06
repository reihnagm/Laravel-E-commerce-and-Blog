<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdProducts extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

  
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
