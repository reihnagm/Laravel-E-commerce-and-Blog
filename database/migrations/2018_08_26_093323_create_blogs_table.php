<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('tag_id')->nullable();
            $table->string('caption')->nullable();
            $table->Longtext('desc');
            $table->boolean('draft')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE blogs ADD img MEDIUMBLOB");
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
