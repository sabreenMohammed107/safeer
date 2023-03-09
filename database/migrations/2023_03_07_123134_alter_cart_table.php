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
            $table->string("visa_personal_photo", 150)->nullable();
            $table->string("visa_passport_photo", 150)->nullable();
        });

        Schema::table('visa_details', function (Blueprint $table) {
            $table->string("visa_personal_photo", 150)->nullable();
            $table->string("visa_passport_photo", 150)->nullable();
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
