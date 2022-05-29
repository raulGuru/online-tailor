<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTailorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tailors', function (Blueprint $table) {
            $table->id();
            $table->integer('creator')->nullable();
            $table->string('name');
            $table->string('shop_name');
            $table->string('location');
            $table->string('pin_code');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('phone')->nullable();
            $table->float('commission');
            $table->string('address');
            $table->text('services');
            $table->text('appointments');
            $table->string('expertise')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('photos')->nullable();
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
        Schema::dropIfExists('tailors');
    }
}
