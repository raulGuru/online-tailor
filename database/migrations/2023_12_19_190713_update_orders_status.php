<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE orders MODIFY status ENUM('initiated','deleted','placed','delivered','failed','in progress','out for delivery') NOT NULL DEFAULT 'initiated'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         DB::statement("ALTER TABLE orders MODIFY status ENUM('initiated','deleted','placed','delivered','failed') NOT NULL");
    }
}
