<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->Longtext('desc');
            $table->decimal('price');
            $table->string('slug')->unique();
            $table->unsignedInteger('category_id')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE products ADD img MEDIUMBLOB");
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
