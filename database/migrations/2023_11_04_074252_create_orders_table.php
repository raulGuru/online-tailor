<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('login_id');
            $table->enum('status', ['initiated','deleted','placed','delivered'])->defaul('initiated');
            $table->timestamp('order_date')->useCurrent();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->text('address');
            $table->text('billing_address');
            $table->double('discount')->default(0);
            $table->double('delivery_charge')->default(0);
            $table->double('amount')->default(0);
            $table->integer('tailor_id');
            $table->text('instamojo_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
