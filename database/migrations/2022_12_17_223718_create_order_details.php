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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string("room_type", 100);
            $table->string("room_view", 100);
            $table->string("food_bev_type", 100);
            $table->float("room_cost");
            $table->float("total_cost");
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels');

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
        Schema::dropIfExists('order_details');
    }
};
