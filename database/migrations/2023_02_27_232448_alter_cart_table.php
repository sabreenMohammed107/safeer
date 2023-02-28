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
            $table->dropForeign(['visa_country_id']);
            $table->dropForeign(['visa_nationality_id']);
            $table->dropForeign(['visa_type_id']);
            $table->dropColumn('visa_country_id');
            $table->dropColumn('visa_nationality_id');
            $table->dropColumn('visa_type_id');

            $table->unsignedBigInteger('visa_id')->nullable();
            $table->foreign('visa_id')->references('id')->on('visas');
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
