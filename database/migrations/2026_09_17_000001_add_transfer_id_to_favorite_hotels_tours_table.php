<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('transfer_id')->nullable()->after('tour_id');
            $table->foreign('transfer_id')->references('id')->on('transfers');
        });

        // Remove duplicate favourite rows (same user + hotel/tour/transfer) before
        // adding the unique constraint below, keeping the oldest row of each set.
        DB::statement("
            DELETE t1 FROM favorite_hotels_tours t1
            INNER JOIN favorite_hotels_tours t2
                ON t1.user_id <=> t2.user_id
                AND t1.hotel_id <=> t2.hotel_id
                AND t1.tour_id <=> t2.tour_id
                AND t1.transfer_id <=> t2.transfer_id
                AND t1.id > t2.id
        ");

        Schema::table('favorite_hotels_tours', function (Blueprint $table) {
            $table->unique(['user_id', 'hotel_id', 'tour_id', 'transfer_id'], 'uniq_user_fav');
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
            $table->dropForeign(['transfer_id']);
            $table->dropColumn('transfer_id');
        });
    }
};
