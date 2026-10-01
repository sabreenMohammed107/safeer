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
            $table->date('offer_date')->nullable()->after('cost')->index();
        });

        // Backfill existing offers so the public date filter works for them too.
        DB::table('offers')
            ->whereNull('offer_date')
            ->update(['offer_date' => DB::raw('DATE(created_at)')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropIndex(['offer_date']);
            $table->dropColumn('offer_date');
        });
    }
};
