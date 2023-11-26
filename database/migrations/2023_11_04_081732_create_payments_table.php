<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->text('payment_request_id');
            $table->text('payment_id')->nullable();
            $table->double('amount');
            $table->string('payment_mode')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('buyer_name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('login_id');
            $table->text('payment_response')->nullable();
            $table->integer('order_id');
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
        Schema::dropIfExists('payments');
    }
}
