<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name', 50);
            $table->string('product_slug', 50)->unique();
            $table->string('product_image')->nullable()->default('image/12.jpg');
            $table->text('product_description')->nullable();
            $table->float('product_price')->unsigned();
            $table->integer('rating')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
