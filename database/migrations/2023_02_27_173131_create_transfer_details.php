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
        Schema::create('transfer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_id')->nullable(); // Reference for extra data
            $table->foreign('transfer_id')->references('id')->on('transfers');
            $table->unsignedBigInteger('order_details_id')->nullable();
            $table->foreign('order_details_id')->references('id')->on('order_details');
            $table->date('transfer_date');
            $table->string("transfer_from", 200);
            $table->string("transfer_to", 200);
            $table->string("car_model", 150);
            $table->string("car_class", 150);
            $table->string("car_image", 150);
            $table->integer("car_capacity");
            $table->float("transfer_person_price");
            $table->float("transfer_total_cost");


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
        Schema::dropIfExists('transfer_details');
    }
};
