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
        Schema::table('order_persons', function (Blueprint $table) {
            /**
             * Altering Persons Table ->
             *      Reasons : 1. Attaching the persons reference to the right entity which is the purchased item (Order_Details)
             *                2. It's one of the main reasons of the interfacing layer as instead of duplicating tables to carry same
             *                   persons data, one table points to the interfacing layer (Order_details table)
             */
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
            $table->unsignedBigInteger('order_details_id')->nullable();
            $table->foreign('order_details_id')->references('id')->on('order_details');
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
