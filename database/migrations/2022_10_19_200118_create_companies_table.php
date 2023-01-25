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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('overview_entitle', 250)->nullable();
            $table->string('overview_artitle', 250)->nullable();
            $table->string('overview_ensubtitle', 250)->nullable();
            $table->string('overview_arsubtitle', 250)->nullable();
            $table->longText('overview_en')->nullable();
            $table->longText('overview_ar')->nullable();
            $table->string('image', 250)->nullable();
            $table->longText('mission_en')->nullable();
            $table->longText('mission_ar')->nullable();
            $table->longText('vision_en')->nullable();
            $table->longText('vision_ar')->nullable();
            $table->string('facebook', 250)->nullable();
            $table->string('youtube', 250)->nullable();
            $table->string('instagram', 250)->nullable();
            $table->longText('best_hotels_en_desc')->nullable();
            $table->longText('best_hotels_ar_desc')->nullable();
            $table->longText('book_tour_en_desc')->nullable();
            $table->longText('book_tour_ar_desc')->nullable();

            $table->string('book_tour_vedio', 250)->nullable();
            $table->string('book_tour_en_title', 250)->nullable();
            $table->string('book_tour_ar_title', 250)->nullable();
            $table->longText('book_transport_en_desc')->nullable();

            $table->longText('book_transport_ar_desc')->nullable();
            $table->string('book_transport_vedio', 250)->nullable();
            $table->string('book_transport_en_title', 250)->nullable();
            $table->string('book_transport_ar_title', 250)->nullable();
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
        Schema::dropIfExists('companies');
    }
};
