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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();

            $table->string('hotel_enname', 250)->nullable();
            $table->string('hotel_arname', 250)->nullable();
            $table->longText('hotel_enoverview')->nullable();
            $table->longText('hotel_aroverview')->nullable();
            $table->unsignedBigInteger('hotel_type_id')->nullable();
            $table->integer('hotel_stars')->default(1);
            $table->string('hotel_logo', 250)->nullable();
            $table->text('hotel_banner')->nullable();
            $table->longText('hotel_enbrief')->nullable();
            $table->longText('hotel_arbrief')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->longText('details_enaddress')->nullable();
            $table->longText('details_araddress')->nullable();
            $table->longText('google_map')->nullable();
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('hotels');
    }
};
