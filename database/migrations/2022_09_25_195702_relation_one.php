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
        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
                   });

        Schema::table('galleries', function (Blueprint $table) {
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('tour_id')->references('id')->on('tours');


        });
        Schema::table('hotels', function (Blueprint $table) {
            $table->foreign('hotel_type_id')->references('id')->on('room_types');
            $table->foreign('city_id')->references('id')->on('cities');


        });

        Schema::table('tours', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities');
                   });

        Schema::table('hotels_features', function (Blueprint $table) {
            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('hotel_id')->references('id')->on('hotels');


        });
        Schema::table('features', function (Blueprint $table) {
            $table->foreign('feature_category_id')->references('id')->on('features_categories');



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
