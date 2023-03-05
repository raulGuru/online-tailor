<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurmentShirtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurment_shirts', function (Blueprint $table) {
            $table->id();
            $table->integer('creator')->nullable();
            $table->string('order_id')->nullable();
            $table->integer('product_type_id');
            $table->integer('Length');
            $table->integer('shoulder');
            $table->integer('full_sleeve_length');
            $table->integer('half_sleeve_length');
            $table->integer('cuff');
            $table->integer('arm');
            $table->integer('chest');
            $table->integer('waist');
            $table->integer('hip');
            $table->integer('neck');
            $table->integer('pocket');
            $table->string('style_details');
            $table->string('body_posture_details');
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
        Schema::dropIfExists('measurment_shirts');
    }
}
