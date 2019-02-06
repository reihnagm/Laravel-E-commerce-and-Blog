<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProviderUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
        });
    }
}
