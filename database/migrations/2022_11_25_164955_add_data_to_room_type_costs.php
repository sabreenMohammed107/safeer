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
        Schema::table('room_type_costs', function (Blueprint $table) {
            //
            $table->double('single_cost', 8, 2)->nullable();
            $table->double('double_cost', 8, 2)->nullable();
            $table->double('triple_cost', 8, 2)->nullable();
            $table->double('extra_bed_cost', 8, 2)->nullable();
            $table->string('child_free_age_from')->nullable();
            $table->string('child_free_age_to')->nullable();
            $table->string('child_age_from')->nullable();
            $table->string('child_age_to')->nullable();
            $table->double('child_age_cost', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_type_costs', function (Blueprint $table) {
            //
        });
    }
};
