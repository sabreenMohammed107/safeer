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
        Schema::table('hotels', function (Blueprint $table) {
            // AA: Custom name for a foreign as it gives me an error (Duplicate Key)
            $table->foreign('hotel_type_id',"hotels_type_id_foreign")
                ->references('id')
                ->on('hotel_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropForeign(['hotel_type_id']);
        });
    }
};
