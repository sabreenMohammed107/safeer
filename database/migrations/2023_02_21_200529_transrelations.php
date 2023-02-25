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
        Schema::table('transfers', function (Blueprint $table) {
            $table->foreign('from_location_id')->references('id')->on('transfer_locations');
            $table->foreign('to_location_id')->references('id')->on('transfer_locations');
            $table->foreign('car_model_id')->references('id')->on('car_models');
            $table->foreign('class_id')->references('id')->on('car_classes');
            $table->foreign('currency_id')->references('id')->on('currencies');
                   });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
