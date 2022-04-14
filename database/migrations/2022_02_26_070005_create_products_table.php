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
            $table->integer('creator');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('sku');
            $table->integer('cat_id');
            $table->integer('type_id');
            $table->integer('color_id');
            $table->integer('size');
            $table->float('price');
            $table->string('thumbnail')->nullable();
            $table->text('images')->nullable();
            $table->text('description')->nullable();
            $table->text('additional_details')->nullable();
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
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
