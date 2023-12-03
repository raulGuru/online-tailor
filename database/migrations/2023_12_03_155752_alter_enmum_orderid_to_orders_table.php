<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEnmumOrderidToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
             $table->enum('status', ['initiated','deleted','placed','delivered','failed'])->default('initiated');
              $table->string('instamojo_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
             $table->dropColumn('instamojo_order_id');
             $table->enum('status', ['initiated','deleted','placed','delivered'])->default('initiated');
        });
    }
}
