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
        Schema::create('room_type_costs', function (Blueprint $table) {
            $table->id();

            $table->date('from_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('cost',10,2)->nullable();
            $table->unsignedBigInteger('hotel_room_id')->nullable();
            $table->foreign('hotel_room_id')->references('id')->on('hotel_rooms');
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
        Schema::dropIfExists('room_type_costs');
    }
};
