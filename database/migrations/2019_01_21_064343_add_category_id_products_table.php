<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdProductsTable extends Migration
{
    public function up()
    {
      Schema::table('products', function (Blueprint $table) {
          $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
      });
    }


    public function down()
    {
      Schema::table('products', function (Blueprint $table) {
          $table->dropColumn('category_id');
      });
    }
}
