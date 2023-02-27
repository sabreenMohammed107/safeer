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
        Schema::table('cart', function (Blueprint $table) {
            $table->unsignedBigInteger('visa_country_id')->nullable();
            $table->foreign('visa_country_id')->references('id')->on('countries');

            $table->unsignedBigInteger('visa_nationality_id')->nullable();
            $table->foreign('visa_nationality_id')->references('id')->on('nationalities');

            $table->unsignedBigInteger('visa_type_id')->nullable();
            $table->foreign('visa_type_id')->references('id')->on('visa_types');

            $table->string("visa_name",100)->nullable();
            $table->string("visa_phone", 50)->nullable();
            $table->string("visa_email",100)->nullable();

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
