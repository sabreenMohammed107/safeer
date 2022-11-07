<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_type_costs', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->unsignedBigInteger('food_beverage_id')->nullable();
            $table->foreign('food_beverage_id')->references('id')->on('food_beverages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_type_costs', function (Blueprint $table) {
            //
        });
    }
};
