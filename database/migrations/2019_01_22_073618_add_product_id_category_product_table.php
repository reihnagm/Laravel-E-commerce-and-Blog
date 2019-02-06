<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductIdCategoryProductTable extends Migration
{
    public function up()
    {
        Schema::table('category_product', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }


    public function down()
    {
      Schema::table('category_product', function (Blueprint $table) {
          $table->dropColumn('product_id');
      });
    }
}
