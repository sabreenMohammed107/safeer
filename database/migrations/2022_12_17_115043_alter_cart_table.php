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
            //
            $table->integer('adults_count')->default(0);
            $table->integer('children_count')->default(0);
            $table->integer('rooms_count')->default(1);
            $table->integer('nights')->default(1);
            $table->date('from_date');
            $table->date('to_date');
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
