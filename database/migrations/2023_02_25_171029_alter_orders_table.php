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
        Schema::table('orders', function (Blueprint $table) {
            /**
             * Restructuring Orders Table Cycles:
             *      . Each Order has (->) Order_Details  ------> Check Order_Details
             *
             * Orders Content:
             *      . {
             *              user_id -> Which site_user account performed this order,
             *              timestamps -> Which indicates the time at which the order is performed
             *        }
             */
            $table->dropColumn('holder_salutation');
            $table->dropColumn('holder_name');
            $table->dropColumn('holder_mobile');
            $table->dropColumn('notes');
            $table->dropColumn('from_date');
            $table->dropColumn('to_date');
            $table->dropColumn('nights');
            $table->dropColumn('adults_count');
            $table->dropColumn('children_count');
            $table->dropColumn('rooms_count');
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
