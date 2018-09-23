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
          $table->unsignedInteger('category_id');
          $table->unsignedInteger('product_id');
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
          $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
          $table->timestamps();
          
        });

    }

    public function down()
    {

        Schema::dropIfExists('category_product');

    }
}
