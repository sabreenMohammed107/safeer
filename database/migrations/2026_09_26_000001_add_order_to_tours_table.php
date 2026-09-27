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
        Schema::table('tours', function (Blueprint $table) {
            $table->integer('order')->nullable()->default(0)->index()->after('active');
        });

        // Backfill existing rows with their current id-based sequence so the
        // display order stays unchanged until an admin rearranges them.
        DB::table('tours')->orderBy('id')->select('id')->get()->each(function ($tour, $index) {
            DB::table('tours')->where('id', $tour->id)->update(['order' => $index + 1]);
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
            $table->dropIndex(['order']);
            $table->dropColumn('order');
        });
    }
};
