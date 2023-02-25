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
        /**
         * General Purpose Cart that can stand all kinds of items (AS IT'S TEMP ITEM PURCHASING)
         */
        Schema::table('cart', function (Blueprint $table) {
            $table->integer('item_type'); // Type Options : [0=>Rooms,1=>Tours,2=>Transfer,3=>Visa]
            $table->unsignedBigInteger('tour_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tours');
            $table->date('tour_date')->nullable();
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
