<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{

    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
