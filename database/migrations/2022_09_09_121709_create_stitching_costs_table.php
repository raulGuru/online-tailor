<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStitchingCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stitching_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tailor_id');
            $table->foreign('tailor_id')->references('id')->on('tailors')->onDelete('cascade');
            $table->string('stitch_name');
            $table->float('cost')->default(0);
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
        Schema::dropIfExists('stitching_costs');
    }
}
