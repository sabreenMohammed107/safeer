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
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->string('en_name', 250)->nullable();
            $table->string('ar_name', 250)->nullable();
            $table->unsignedBigInteger('tour_type_id')->nullable();
            $table->foreign('tour_type_id')->references('id')->on('tour_types');
            $table->text('thumbnail')->nullable();
            $table->string('tour_vedio', 250)->nullable();
            $table->text('duration')->nullable();
            $table->string('tour_en_language', 250)->nullable();
            $table->string('tour_ar_language', 250)->nullable();
            $table->string('tour_en_days', 250)->nullable();
            $table->string('tour_ar_days', 250)->nullable();
            $table->double('tour_person_cost',10,2)->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->text('en_notes')->nullable();
            $table->text('ar_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
        });
    }
};
