<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_timings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tailor_id');
            $table->foreign('tailor_id')->references('id')->on('tailors')->onDelete('cascade');
            $table->string('monday_opens', 50)->nullable();
            $table->string('monday_closes', 50)->nullable();
            $table->string('tuesday_opens', 50)->nullable();
            $table->string('tuesday_closes', 50)->nullable();
            $table->string('wednesday_opens', 50)->nullable();
            $table->string('wednesday_closes', 50)->nullable();
            $table->string('thursday_opens', 50)->nullable();
            $table->string('thursday_closes', 50)->nullable();
            $table->string('friday_opens', 50)->nullable();
            $table->string('friday_closes', 50)->nullable();
            $table->string('saturday_opens', 50)->nullable();
            $table->string('saturday_closes', 50)->nullable();
            $table->string('sunday_opens', 50)->nullable();
            $table->string('sunday_closes', 50)->nullable();
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
        Schema::dropIfExists('store_timings');
    }
}
