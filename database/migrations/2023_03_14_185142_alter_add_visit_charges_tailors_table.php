<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddVisitChargesTailorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tailors', function (Blueprint $table) {
            $table->float('visit_charges')->after('commission')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tailors', function (Blueprint $table) {
            $table->dropColumn(['visit_charges']);
        });
    }
}
