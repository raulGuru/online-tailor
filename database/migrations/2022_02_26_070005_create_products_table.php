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
            $table->integer('cat_id'); // done
            $table->integer('color_id'); // done
            $table->integer('size_id'); // done
            $table->integer('type_id'); // done
            $table->integer('sleeve_id'); // done
            $table->string('title'); // done
            $table->string('sku'); // done
            $table->string('slug'); // done
            $table->float('price'); // done
            $table->float('discount')->nullable(); // done
            $table->string('coupon')->nullable();  // done
            $table->string('thumbnail')->nullable();
            $table->text('images')->nullable();
            $table->text('description')->nullable();
            $table->text('additional_details')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
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
