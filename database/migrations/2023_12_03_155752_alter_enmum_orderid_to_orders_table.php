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
        DB::statement("ALTER TABLE orders MODIFY status ENUM('initiated','deleted','placed','delivered','failed') NOT NULL DEFAULT 'initiated'");

        Schema::table('orders', function (Blueprint $table) {
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
        DB::statement("ALTER TABLE orders MODIFY status ENUM('initiated','deleted','placed','delivered') NOT NULL");
        Schema::table('orders', function (Blueprint $table) {
             $table->dropColumn('instamojo_order_id');
        });
    }
}
