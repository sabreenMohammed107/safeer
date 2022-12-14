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
        Schema::table('site_users', function (Blueprint $table) {
            //
            $table->string('image', 250)->after('id')->nullable();
            $table->string('first_name', 250)->after('image')->nullable();
            $table->string('last_name', 250)->after('first_name')->nullable();
            $table->string('phone', 250)->after('last_name')->nullable();
            $table->text('address')->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_users', function (Blueprint $table) {
            //
        });
    }
};
