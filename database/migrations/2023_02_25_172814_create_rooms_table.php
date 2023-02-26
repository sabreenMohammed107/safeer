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
        Schema::create('rooms_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_details_id')->nullable();
            $table->foreign('order_details_id')->references('id')->on('order_details');

            $table->string("room_type", 100);
            $table->string("room_view", 100);
            $table->string("food_bev_type", 100);

            $table->float("room_cost");
            $table->float("total_cost");

            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels');

            $table->date('from_date');
            $table->date('to_date');

            $table->integer('nights')->default(1);
            $table->integer('adults_count')->default(1);
            $table->integer('children_count')->default(0);
            $table->integer('rooms_count')->default(1);

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
        Schema::dropIfExists('rooms');
    }
};
