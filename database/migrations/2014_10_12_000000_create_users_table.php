<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('email')->nullable(); // unique() prevent to duplicate if use socialite remove it
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });

          DB::statement("ALTER TABLE users ADD avatar MEDIUMBLOB");

    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
