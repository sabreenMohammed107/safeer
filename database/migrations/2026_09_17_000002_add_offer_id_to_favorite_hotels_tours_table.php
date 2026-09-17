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
        Schema::table('favorite_hotels_tours', function (Blueprint $table) {
            $table->dropUnique('uniq_user_fav');
        });

        Schema::table('favorite_hotels_tours', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id')->nullable()->after('transfer_id');
            $table->foreign('offer_id')->references('id')->on('offers');
        });

        Schema::table('favorite_hotels_tours', function (Blueprint $table) {
            $table->unique(['user_id', 'hotel_id', 'tour_id', 'transfer_id', 'offer_id'], 'uniq_user_fav');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorite_hotels_tours', function (Blueprint $table) {
            $table->dropUnique('uniq_user_fav');
            $table->dropForeign(['offer_id']);
            $table->dropColumn('offer_id');
        });

        Schema::table('favorite_hotels_tours', function (Blueprint $table) {
            $table->unique(['user_id', 'hotel_id', 'tour_id', 'transfer_id'], 'uniq_user_fav');
        });
    }
};
