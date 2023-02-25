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
        Schema::table('order_details', function (Blueprint $table) {
            /**
             * Order_Details:
             *      . Order_Details acts as the interface layer that points to [Tours, Rooms, Transfer, Visa]
             *      . Order_Details refers to purchased item details
             *          {order_id, holder-* (Holder data), notes, type}
             *      . Each Order_Details has (->) Tour, Visa, Transfer, Room ---> (1)Record
             *                               (->) Persons (Adults, Children) Tuples
             */

             // Removed Column --Old Structure--
            $table->dropColumn("room_type");
            $table->dropColumn("room_view");
            $table->dropColumn("food_bev_type");
            $table->dropColumn("room_cost");
            $table->dropColumn("total_cost");
            $table->dropForeign(['hotel_id']);
            $table->dropColumn('hotel_id');
            // Added Column --Previously was in Orders Table--
            $table->string('holder_salutation', 20)->default("MR");
            $table->string('holder_name', 100);
            $table->string('holder_mobile', 20);
            $table->string('notes', 250)->nullable();
            $table->integer("detail_type"); // Type Options : [0=>Rooms,1=>Tours,2=>Transfer,3=>Visa]
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
