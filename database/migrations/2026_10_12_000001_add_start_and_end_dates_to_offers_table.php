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
        Schema::table('offers', function (Blueprint $table) {
            $table->dateTime('start_date')->nullable()->after('offer_date')->index();
            $table->dateTime('end_date')->nullable()->after('start_date')->index();
        });

        // Backfill existing offers with the validity they already had: running
        // from creation through the end of their offer_date (never before start).
        DB::table('offers')->whereNull('start_date')->update(['start_date' => DB::raw('created_at')]);
        DB::table('offers')
            ->whereNull('end_date')
            ->whereNotNull('offer_date')
            ->update(['end_date' => DB::raw("GREATEST(CONCAT(offer_date, ' 23:59:59'), start_date)")]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropIndex(['start_date']);
            $table->dropIndex(['end_date']);
            $table->dropColumn(['start_date', 'end_date']);
        });
    }
};
