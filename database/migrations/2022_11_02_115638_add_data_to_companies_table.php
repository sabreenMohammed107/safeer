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
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->string('master_page_img_bg', 250)->after('id')->nullable();
            $table->string('master_page_entitle', 250)->after('master_page_img_bg')->nullable();
            $table->string('master_page_artitle', 250)->after('master_page_entitle')->nullable();
            $table->string('master_page_ensubtitle', 250)->after('master_page_artitle')->nullable();
            $table->string('master_page_arsubtitle', 250)->after('master_page_ensubtitle')->nullable();
            $table->text('master_page_entext')->after('master_page_arsubtitle')->nullable();
            $table->text('master_page_artext')->after('master_page_entext')->nullable();
            $table->text('limit_offer_endesc')->after('master_page_artext')->nullable();
            $table->text('limit_offer_ardesc')->after('limit_offer_endesc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
