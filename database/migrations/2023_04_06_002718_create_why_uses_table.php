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
        Schema::create('why_uses', function (Blueprint $table) {
            $table->id();
            $table->string('icon', 250)->nullable();
            $table->string('en_title', 250)->nullable();
            $table->string('ar_title', 250)->nullable();
            $table->text('en_text')->nullable();
            $table->text('ar_artext')->nullable();
            $table->string('chat_whatsapp', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('why_uses');
    }
};
