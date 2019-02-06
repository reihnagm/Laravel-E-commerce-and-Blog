<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->integer('order')->default(1);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('categories');
    }
}
