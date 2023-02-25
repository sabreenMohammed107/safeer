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
        Schema::create('tours_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_details_id')->nullable();
            $table->foreign('order_details_id')->references('id')->on('order_details');

            $table->unsignedBigInteger('tour_id')->nullable();
            $table->foreign('tour_id')->references('id')->on('tours');

            $table->string("tour_name", 150);
            $table->string("tour_banner", 200);
            $table->boolean("tour_type"); // [0 => Private, 1 => Group]

            $table->float("tour_cost");
            $table->float("total_cost");


            $table->date('tour_date');

            $table->integer('adults_count')->default(1);
            $table->integer('children_count')->default(0);

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
        Schema::dropIfExists('tours');
    }
};
